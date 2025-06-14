<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Mail\QrCodeMail;
use App\Models\Sps\Profile;
use App\Models\Sps\ProhibitedItem;
use App\Models\Sps\StoredItem;
use Carbon\Carbon;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class ProfileController extends Controller
{
    public function index()
    {
        $prohibited_items = ProhibitedItem::all();
        // dd($prohibited_items);
        return view('spss.customer.visitor', ['prohibitedItems' => $prohibited_items]);
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
            // return response()->json(['errors' => $validator->errors()], 422);
            return redirect()->route('spss.customer.visitor')->with('errors', $validator->errors());
        }

        // 3. Create profile
        $visitor = new Profile();
        $visitor->first_name = $request->first_name;
        $visitor->last_name = $request->last_name;
        $visitor->phone = $request->phone;
        $visitor->email_address = $request->email_address;

        $visitor->save();

        // 4. Handle items
        // $items = new StoredItem();

        Log::info('Prohibited Item IDs: ' . json_encode($request->prohibited_item_id));
        Log::info('Count Prohibited Item IDs: ' . count($request->prohibited_item_id));

        foreach ($request->prohibited_item_id as $key => $item) {
            Log::info('Processing Prohibited Item ID: ' . $item);
            $items = new StoredItem();
            $items->profile_id = $visitor->id;
            $items->item_id = $request->prohibited_item_id[$key];
            $items->item_description = $request->item_description[$key] ?? null;

            $items->save();
            Log::info('Stored Item: ' . json_encode($items));
        }




        // $items->item_quantity = $request->item_quantity;
        $notification = array(
            'message'       => 'Visitor Information created!',
            'alert-type'    => 'success'
        );



        return redirect()->route('spss.customer.confirmation', ['profile' => $visitor])->with($notification);
        // return redirect()->route('spss.customer.profile')->with($notification);

        // return response()->json(['message' => 'Profile created successfully', 'profile' => $profile], 201);
    }

    public function confirmationkk(Profile $profile)
    {
        $qrCode = QrCode::format('svg')->size(200)->margin(1)->backgroundColor(255, 255, 255)->generate($profile->ref_number);
        $qrBase64 = base64_encode($qrCode);


        //Generate QR code and store it
        $filename = 'qrcodes/profile-' . $profile->id . '-' . Str::random(6) . '.png';
        Storage::put('public/' . $filename, $qrCode);
        // Get the full path
        $filePath = storage_path('app/public/' . $filename);

        Mail::to($profile->email_address)->send(new QrCodeMail($profile, $filePath));
        return view('spss.customer.confirmation', compact('profile', 'qrBase64'));
    }

    public function confirmation(Profile $profile)
    {
        $result = Builder::create()
            ->writer(new PngWriter())           // Ensure PNG format
            ->data($profile->ref_number)                       // QR code content
            ->size(300)                         // Image size (px)
            ->margin(10)                        // Margin (quiet zone)
            ->backgroundColor(new Color(255, 255, 255)) // Background color
            ->build();

        $filename = 'qrcodes/profile-' . $profile->id . '-' . Str::random(6) . '.png';

        Storage::put('public/' . $filename, $result->getString());
        // Get the full path
        $filePath = storage_path('app/public/' . $filename);

        // $filePath = public_path('qrcodes/sps-visitor-' . $profile->id . '-' . Str::random(6) . '.png');
        // $result->saveToFile($filePath);

        Mail::to($profile->email_address)->send(new QrCodeMail($profile, $filePath));

        return view('spss.customer.confirmation', ['profile' => $profile, 'qrBase64' => base64_encode($result->getString())]);

        return response($result->getString(), 200)
            ->header('Content-Type', 'image/png');
    }

    public function save($text = 'https://example.com')
    {
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($text)
            ->size(300)
            ->margin(10)
            ->build();

        $filePath = public_path('qrcodes/qr.png');
        $result->saveToFile($filePath);

        return "QR code saved to: /qrcodes/qr.png";
    }
}
