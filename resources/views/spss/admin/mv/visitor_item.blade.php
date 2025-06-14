<script src="{{ asset('fnx/assets/js/phoenix.js') }}"></script>

<div class="row g-3 mb-6">
    <div class="col-12 col-lg-4">
        <div class="card bg-primary-subtle h-100">
            <div class="card-body">
                <div class="border-bottom border-dashed">
                    <h4 class="mb-3">Person Information
                        <button class="btn btn-link p-0" type="button"> <span
                                class="fas fa-edit fs-9 ms-3 text-body-quaternary"></span></button>
                    </h4>
                </div>
                @foreach ($visitors as $visitor)
                    <div class="pt-4 mb-7 mb-lg-4 mb-xl-7">
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <h5 class="text-body-highlight">Reference#</h5>
                            </div>
                            <div class="col-auto">
                                <p class="text-body-secondary">{{ $visitor->ref_number }}</p>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <h5 class="text-body-highlight">First Name</h5>
                            </div>
                            <div class="col-auto">
                                <p class="text-body-secondary">{{ $visitor->first_name }}</p>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <h5 class="text-body-highlight">Last Name</h5>
                            </div>
                            <div class="col-auto">
                                <p class="text-body-secondary">{{ $visitor->last_name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="border-top border-dashed pt-4">
                        <div class="row flex-between-center mb-2">
                            <div class="col-auto">
                                <h5 class="text-body-highlight mb-0">Email</h5>
                            </div>
                            <div class="col-auto"><a class="lh-1"
                                    href="mailto:shatinon@jeemail.com">{{ $visitor->email_address }}</a></div>
                        </div>
                        <div class="row flex-between-center">
                            <div class="col-auto">
                                <h5 class="text-body-highlight mb-0">Phone</h5>
                            </div>
                            <div class="col-auto"><a href="tel:+1234567890">{{ $visitor->phone }}</a></div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-8">
        <div class="card bg-secondary-subtle h-100">
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-orders" role="tabpanel" aria-labelledby="orders-tab">
                        <div class="border-top border-bottom border-translucent" id="profileOrdersTable"
                            data-list='{"valueNames":["order","status","delivery","date","total"],"page":6,"pagination":true}'>
                            <div class="table-responsive scrollbar">
                                <table class="table fs-9 mb-0">
                                    <thead>
                                        <tr>
                                            <th class="sort white-space-nowrap align-middle pe-3 ps-0" scope="col"
                                                data-sort="order" style="width:15%; min-width:140px">LOC</th>
                                            <th class="sort align-middle pe-3" scope="col" data-sort="status"
                                                style="width:15%; min-width:180px">STATUS</th>
                                            <th class="sort align-middle text-start" scope="col" data-sort="delivery"
                                                style="width:20%; min-width:160px">ITEM DESCRIPTION</th>
                                            <th class="sort align-middle pe-0 text-end" scope="col" data-sort="date"
                                                style="width:15%; min-width:160px">TIME</th>
                                            <th class="sort align-middle pe-0 text-end" scope="col" data-sort="date"
                                                style="width:15%; min-width:160px">DATE</th>
                                            <th class="align-middle pe-0 text-end" scope="col" style="width:15%;">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="profile-order-table-body">
                                        @foreach ($visitor->items as $item)
                                            <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                                <td class="order align-middle white-space-nowrap py-2 ps-0"><a
                                                        class="fw-semibold text-primary" href="#!">#2453</a></td>
                                                <td
                                                    class="status align-middle white-space-nowrap text-start fw-bold text-body-tertiary py-2">
                                                    <span class="badge badge-phoenix fs-10 badge-phoenix-success"><span
                                                            class="badge-label">Stored</span><span class="ms-1"
                                                            data-feather="check"
                                                            style="height:12.8px;width:12.8px;"></span></span>
                                                </td>
                                                <td class="delivery align-middle white-space-nowrap text-body py-2">
                                                    {{ $item->item_description }}</td>
                                                <td class="total align-middle text-body-tertiary text-end py-2">{{ $item->created_at->format('h:i A') }}</td>
                                                <td class="total align-middle text-body-tertiary text-end py-2">{{ $item->created_at->format('d M Y') }}</td>
                                                <td class="align-middle text-end white-space-nowrap pe-0 action py-2">
                                                    <div class="btn-reveal-trigger position-static">
                                                        <button
                                                            class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal"
                                                            type="button" data-bs-toggle="dropdown"
                                                            data-boundary="window" aria-haspopup="true"
                                                            aria-expanded="false" data-bs-reference="parent"><span
                                                                class="fas fa-ellipsis-h fs-10"></span></button>
                                                        <div class="dropdown-menu dropdown-menu-end py-2"><a
                                                                class="dropdown-item" href="#!">View</a><a
                                                                class="dropdown-item" href="#!">Export</a>
                                                            <div class="dropdown-divider"></div><a
                                                                class="dropdown-item text-danger"
                                                                href="#!">Remove</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
