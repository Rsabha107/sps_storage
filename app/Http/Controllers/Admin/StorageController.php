<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\QrCodeMail;
use App\Models\Sps\Profile;
use App\Models\Sps\ProhibitedItem;
use App\Models\Sps\StoredItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class StorageController extends Controller
{
    public function index()
    {
        $projibitedItems = ProhibitedItem::all();
        return view('spss.admin.list', ['prohibitedItems' => $projibitedItems]);
    }

    public function list()
    {
        Log::info('inside Admin ProfileController::list');
        Log::info(request()->all());

        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $mds_schedule_event_filter = (request()->mds_schedule_event_filter) ? request()->mds_schedule_event_filter : "";
        $mds_schedule_venue_filter = (request()->mds_schedule_venue_filter) ? request()->mds_schedule_venue_filter : "";
        $mds_schedule_rsp_filter = (request()->mds_schedule_rsp_filter) ? request()->mds_schedule_rsp_filter : "";
        $mds_date_range_filter = (request()->mds_date_range_filter) ? request()->mds_date_range_filter : "";

        // if ($mds_date_range_filter == "") {
        //     $mds_date_range_filter = date('Y-m-d') . ' to ' . date('Y-m-d');
        // }

        // Carbon::createFromFormat('d/m/Y', $request->slot_visibility)->toDateString()

        $ops = Profile::orderBy($sort, $order);

        if ($search) {
            $ops = $ops->where(function ($query) use ($search) {
                $query
                    ->where('ref_number', 'like', '%' . $search . '%')
                    ->orWhere('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('email_address', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }


        if ($mds_schedule_event_filter) {
            $ops = $ops->where('event_id', $mds_schedule_event_filter);
        }

        if ($mds_schedule_venue_filter) {
            $ops = $ops->where('venue_id', $mds_schedule_venue_filter);
        }

        if ($mds_schedule_rsp_filter) {
            $ops = $ops->where('rsp_id', $mds_schedule_rsp_filter);
        }

        if ($mds_date_range_filter) {
            $dates = explode('to', $mds_date_range_filter);
            $startDate = trim($dates[0]);
            if (count($dates) > 1) {
                $endDate = trim($dates[1]);
            } else {
                $endDate = null;
            }
            if ($startDate) {
                $startDate = Carbon::createFromFormat('d/m/y', $startDate)->toDateString();
            }
            if ($endDate) {
                $endDate = Carbon::createFromFormat('d/m/y', $endDate)->toDateString();
            }

            if ($startDate && $endDate) {
                $ops = $ops->whereBetween('booking_date', [$startDate, $endDate]);
            } else if ($startDate) {
                $ops = $ops->where('booking_date', '>=', $startDate);
            } else if ($endDate) {
                $ops = $ops->where('booking_date', '<=', $endDate);
            }
        }

        $total = $ops->count();
        $ops = $ops->paginate(request("limit"))->through(function ($op) {

            // $location = Location::find($booking->location_id);

            if ($op->items()->count() > 0) {
                $items = '<div class="align-middle white-space-wrap fs-9 ps-2">
                            <a href="javascript:void(0)" id="ItemDetails" data-id="' .
                    $op->id .
                    '" data-table="storage_table" data-bs-toggle="tooltip" data-bs-placement="right">
                            <span class="fa-number-circle">' . $op->items()->count() . '</span></a>
                          </div>';
            } else {
                $items = '<div class="align-middle white-space-wrap fs-9 ps-2"><span class="fa-number-circle-zero">0</span></div>';
            }
            // $items = '<div class="font-sans-serif btn-reveal-trigger position-static">' .
            //     '<a href="javascript:void(0)" class="btn btn-sm" id="ItemDetails" data-id="' .
            //     $op->id .
            //     '" data-table="storage_table" data-bs-toggle="tooltip" data-bs-placement="right" title="View Booking Details">' .
            //     '<i class="fas fa-lightbulb text-warning"></i></a></div>';
            $actions =

                '<div class="font-sans-serif btn-reveal-trigger position-static">' .
                '<a href="#" class="btn btn-sm" id="addItem" data-id="' .
                $op->id .
                '" data-table="storage_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Add Items">' .
                '<i class="fa-solid fa-plus text-primary"></i></a>' .
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="storage_table" data-id="' .
                $op->id .
                '" id="deleteVisitorInformatione" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
                '<i class="bx bx-trash text-danger"></i></a></div></div>';

            return  [
                'id' => $op->id,
                // 'id' => '<div class="align-middle white-space-wrap fw-bold fs-8 ps-2">' .$op->id. '</div>',
                'first_name' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . $op->first_name . '</div>',
                'last_name' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . $op->last_name . '</div>',
                'phone' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . $op->phone . '</div>',
                'email_address' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . $op->email_address . '</div>',
                'ref_number' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . $op->ref_number . '</div>',
                'items' => $items,
                'action' => $actions,
                'created_at' => format_date($op->created_at,  'H:i:s'),
                'updated_at' => format_date($op->updated_at, 'H:i:s'),
            ];
        });

        return response()->json([
            "rows" => $ops->items(),
            "total" => $total,
        ]);
    }

    public function store(Request $request)
    {
        // 1. Validate incoming request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'phone'      => 'required|string|max:20',
            'email_address' => 'required|email|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 3. Create profile
        $profile = Profile::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'phone'      => $request->phone,
            'email_address'    => $request->email_address,
        ]);

        $notification = array(
            'message'       => 'Profile created!',
            'alert-type'    => 'success'
        );



        // return redirect()->route('spss.customer.confirmation', ['profile' => $profile])->with($notification);
        // return redirect()->route('spss.customer.profile')->with($notification);

        return response()->json(['message' => 'Profile created successfully', 'profile' => $profile], 201);
    }

    public function itemStore(Request $request)
    {
        // 1. Validate incoming request
        $validator = Validator::make($request->all(), [
            'item_description' => 'required',
        ]);

        if ($validator->fails()) {
            // Log::info($validator->errors());
            $error = true;
            // $message = 'Employee not create.' . $op->id;
            $message = implode($validator->errors()->all('<div>:message</div>'));
        } else {

            $error = false;
            $message = 'Item created successfully.';

            $profile = StoredItem::create([
                'profile_id' => $request->profile_id,
                'item_description' => $request->item_description,
            ]);

            $notification = array(
                'message'       => 'Item added successfully!',
                'alert-type'    => 'success'
            );
        }

        return response()->json([
            'error' => $error,
            'message' => $message,
        ]);
    }

    public function find()
    {

        return view('spss.admin.find');
    }

    // find the visitor by ref_number
    public function get(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ref_number' => 'required',
        ]);

        if ($validator->fails()) {

            $message = implode($validator->errors()->all(':message'));
            $notification = array(
                'message'       => $message,
                'alert-type'    => 'error'
            );

            return back()->with($notification)->withInput();
        }

        $profile = Profile::where('ref_number', $request->ref_number)->first();
        // if ($profile) {
        //     return response()->json(['profile' => $profile], 200);
        // } else {
        //     return response()->json(['message' => 'Profile not found'], 404);
        // }
        if ($profile) {
            $items = StoredItem::where('profile_id', $profile->id)->get();
        }
    }

    public function getItemDescriptionView($id)
    {
        $items = StoredItem::where('profile_id', $id)->get();

        // dd($items);
        $view = view('/spss/admin/mv/items', [
            'items' => $items,
        ])->render();

        return response()->json(['view' => $view]);
    }

    public function getVisitorResultView($id)
    {
        $visitors = Profile::with('items')->where('ref_number', $id)->get();
        // dd($visitors);
        if ($visitors->isEmpty()) {
            $error = true;
            $message = 'No items found for this profile.';
            return response()->json([
                'error' => $error,
                'message' => $message,
            ]);
        }

        $view = view('/spss/admin/mv/visitor_item', [
            'visitors' => $visitors,
        ])->render();

        return response()->json([
            'view' => $view,
            'error' => false,
            'message' => 'Items found for this profile.',
        ]);
    }

    public function deleteVisitor($id)
    {
        $ws = Profile::findOrFail($id);
        $ws->delete();

        $error = false;
        $message = 'Visitor Information deleted succesfully.';

        $notification = array(
            'message'       => 'Delivery Type deleted successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
        // return redirect()->route('tracki.setup.workspace')->with($notification);
    } // delete
}
