<script src="{{ asset('fnx/assets/js/phoenix.js') }}"></script>

<div class="modal-body">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Item Category</th>
                <th scope="col">Item Description</th>
                <th scope="col">Time</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
            <tr>
                <td>{{ $item->prohibited_item->item_name }}</td>
                <td>{{ $item->item_description }}</td>
                <!-- <td><i class="fa fa-circle mr-2 text-success ms-2 me-2"
                        style="color:#16813D"></i>{{ $item->item_description }}
                </td> -->
                <td>{{ $item->created_at->format('h:i A') }}</td>
                <td>{{ $item->created_at->format('d M Y') }}</td>
                <td>
                    @if ($item->status == 0)
                    <span class="badge bg-danger">Pending</span>
                    @elseif ($item->status == 1)
                    <span class="badge bg-success">Approved</span>
                    @else
                    <span class="badge bg-warning">Rejected</span>
                    @endif
                </td>
                <td>Action</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>