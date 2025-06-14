@extends('spss.layout.customer_template')
@section('main')

    <div class="container">
        <form method="POST" action="{{ route('spss.admin.get') }}" class="forms-sample needs-validation" novalidate="" id="visitor_form">
            @csrf
            <input type="hidden" name="venue" value="LUS">
            <div class="row flex-center">

                <div class="col-sm-10 col-md-8 col-lg-10 col-xl-10 col-xxl-10"><a
                        class="d-flex flex-center text-decoration-none mb-4" href="../../../index.html">

                    </a>
                    <div class="card shadow-sm mb-3">
                        <div class="card-body p-4 p-sm-5">
                            <div class="text-center mb-4">
                                <img src="{{ asset('assets/img/icons/logo-placeholder.jpg') }}" alt="phoenix"
                                    width="58" />
                            </div>
                            <div class="text-center mb-7">
                                <h3 class="text-body-highlight">SPS</h3>
                            </div>
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="mb-3 text-start">
                                <label class="form-label" for="email">Reference Number</label>
                                <div class="form-icon-container">
                                    <input class="form-control form-icon-input" name="ref_number" type="text" id="find_ref_number" required/><span
                                        class="fas fa-user text-body fs-9 form-icon"></span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3" id="submitBtn">Find</button>
                        </div>
                                                        <div class="row flex-between-center mb-5">
                                    <div class="col-auto">

                                    </div>
                                    <div class="col-auto"><a class="fs-9 fw-semibold me-5" href="{{ route('spss.admin') }}">Back to Admin</a></div>
                                </div>
                    </div>

                    <div id="visitor-stored-item-content">
                        {{-- <div class="row g-3 mb-6">
                        <div class="col-12 col-lg-4">
                            <div class="card bg-primary-subtle h-100">
                                <div class="card-body">
                                    <div class="border-bottom border-dashed">
                                        <h4 class="mb-3">Person Information
                                            <button class="btn btn-link p-0" type="button"> <span class="fas fa-edit fs-9 ms-3 text-body-quaternary"></span></button>
                                        </h4>
                                    </div>
                                    <div class="pt-4 mb-7 mb-lg-4 mb-xl-7">
                                        <div class="row justify-content-between">
                                            <div class="col-auto">
                                                <h5 class="text-body-highlight">First Name</h5>
                                            </div>
                                            <div class="col-auto">
                                                <p class="text-body-secondary">Vancouver, British Columbia<br />Canada</p>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="col-auto">
                                                <h5 class="text-body-highlight">Last Name</h5>
                                            </div>
                                            <div class="col-auto">
                                                <p class="text-body-secondary">Vancouver, British Columbia<br />Canada</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top border-dashed pt-4">
                                        <div class="row flex-between-center mb-2">
                                            <div class="col-auto">
                                                <h5 class="text-body-highlight mb-0">Email</h5>
                                            </div>
                                            <div class="col-auto"><a class="lh-1" href="mailto:shatinon@jeemail.com">shatinon@jeemail.com</a></div>
                                        </div>
                                        <div class="row flex-between-center">
                                            <div class="col-auto">
                                                <h5 class="text-body-highlight mb-0">Phone</h5>
                                            </div>
                                            <div class="col-auto"><a href="tel:+1234567890">+1234567890</a></div>
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
                                            <div class="border-top border-bottom border-translucent" id="profileOrdersTable" data-list='{"valueNames":["order","status","delivery","date","total"],"page":6,"pagination":true}'>
                                                <div class="table-responsive scrollbar">
                                                    <table class="table fs-9 mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th class="sort white-space-nowrap align-middle pe-3 ps-0" scope="col" data-sort="order" style="width:15%; min-width:140px">ORDER</th>
                                                                <th class="sort align-middle pe-3" scope="col" data-sort="status" style="width:15%; min-width:180px">STATUS</th>
                                                                <th class="sort align-middle text-start" scope="col" data-sort="delivery" style="width:20%; min-width:160px">DELIVERY METHOD</th>
                                                                <th class="sort align-middle pe-0 text-end" scope="col" data-sort="date" style="width:15%; min-width:160px">DATE</th>
                                                                <th class="sort align-middle text-end" scope="col" data-sort="total" style="width:15%; min-width:160px">TOTAL</th>
                                                                <th class="align-middle pe-0 text-end" scope="col" style="width:15%;"> </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="list" id="profile-order-table-body">
                                                            <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                                                <td class="order align-middle white-space-nowrap py-2 ps-0"><a class="fw-semibold text-primary" href="#!">#2453</a></td>
                                                                <td class="status align-middle white-space-nowrap text-start fw-bold text-body-tertiary py-2"><span class="badge badge-phoenix fs-10 badge-phoenix-success"><span class="badge-label">Shipped</span><span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;"></span></span></td>
                                                                <td class="delivery align-middle white-space-nowrap text-body py-2">Cash on delivery</td>
                                                                <td class="total align-middle text-body-tertiary text-end py-2">Dec 12, 12:56 PM</td>
                                                                <td class="date align-middle fw-semibold text-end py-2 text-body-highlight">$87</td>
                                                                <td class="align-middle text-end white-space-nowrap pe-0 action py-2">
                                                                    <div class="btn-reveal-trigger position-static">
                                                                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                                                        <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                                                            <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                                                <td class="order align-middle white-space-nowrap py-2 ps-0"><a class="fw-semibold text-primary" href="#!">#2452</a></td>
                                                                <td class="status align-middle white-space-nowrap text-start fw-bold text-body-tertiary py-2"><span class="badge badge-phoenix fs-10 badge-phoenix-info"><span class="badge-label">Ready to pickup</span><span class="ms-1" data-feather="info" style="height:12.8px;width:12.8px;"></span></span></td>
                                                                <td class="delivery align-middle white-space-nowrap text-body py-2">Free shipping</td>
                                                                <td class="total align-middle text-body-tertiary text-end py-2">Dec 9, 2:28PM</td>
                                                                <td class="date align-middle fw-semibold text-end py-2 text-body-highlight">$7264</td>
                                                                <td class="align-middle text-end white-space-nowrap pe-0 action py-2">
                                                                    <div class="btn-reveal-trigger position-static">
                                                                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                                                        <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                                                            <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                                                <td class="order align-middle white-space-nowrap py-2 ps-0"><a class="fw-semibold text-primary" href="#!">#2451</a></td>
                                                                <td class="status align-middle white-space-nowrap text-start fw-bold text-body-tertiary py-2"><span class="badge badge-phoenix fs-10 badge-phoenix-warning"><span class="badge-label">Partially fulfilled</span><span class="ms-1" data-feather="clock" style="height:12.8px;width:12.8px;"></span></span></td>
                                                                <td class="delivery align-middle white-space-nowrap text-body py-2">Local pickup</td>
                                                                <td class="total align-middle text-body-tertiary text-end py-2">Dec 4, 12:56 PM</td>
                                                                <td class="date align-middle fw-semibold text-end py-2 text-body-highlight">$375</td>
                                                                <td class="align-middle text-end white-space-nowrap pe-0 action py-2">
                                                                    <div class="btn-reveal-trigger position-static">
                                                                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                                                        <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                                                            <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                                                <td class="order align-middle white-space-nowrap py-2 ps-0"><a class="fw-semibold text-primary" href="#!">#2450</a></td>
                                                                <td class="status align-middle white-space-nowrap text-start fw-bold text-body-tertiary py-2"><span class="badge badge-phoenix fs-10 badge-phoenix-secondary"><span class="badge-label">Canceled</span><span class="ms-1" data-feather="x" style="height:12.8px;width:12.8px;"></span></span></td>
                                                                <td class="delivery align-middle white-space-nowrap text-body py-2">Standard shipping</td>
                                                                <td class="total align-middle text-body-tertiary text-end py-2">Dec 1, 4:07 AM</td>
                                                                <td class="date align-middle fw-semibold text-end py-2 text-body-highlight">$657</td>
                                                                <td class="align-middle text-end white-space-nowrap pe-0 action py-2">
                                                                    <div class="btn-reveal-trigger position-static">
                                                                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                                                        <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                                                            <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                                                <td class="order align-middle white-space-nowrap py-2 ps-0"><a class="fw-semibold text-primary" href="#!">#2449</a></td>
                                                                <td class="status align-middle white-space-nowrap text-start fw-bold text-body-tertiary py-2"><span class="badge badge-phoenix fs-10 badge-phoenix-success"><span class="badge-label">fulfilled</span><span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;"></span></span></td>
                                                                <td class="delivery align-middle white-space-nowrap text-body py-2">Express</td>
                                                                <td class="total align-middle text-body-tertiary text-end py-2">Nov 28, 7:28 PM</td>
                                                                <td class="date align-middle fw-semibold text-end py-2 text-body-highlight">$9562</td>
                                                                <td class="align-middle text-end white-space-nowrap pe-0 action py-2">
                                                                    <div class="btn-reveal-trigger position-static">
                                                                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                                                        <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                                                            <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                                                <td class="order align-middle white-space-nowrap py-2 ps-0"><a class="fw-semibold text-primary" href="#!">#2448</a></td>
                                                                <td class="status align-middle white-space-nowrap text-start fw-bold text-body-tertiary py-2"><span class="badge badge-phoenix fs-10 badge-phoenix-danger"><span class="badge-label">Unfulfilled</span><span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;"></span></span></td>
                                                                <td class="delivery align-middle white-space-nowrap text-body py-2">Local delivery</td>
                                                                <td class="total align-middle text-body-tertiary text-end py-2">Nov 24, 10:16 AM</td>
                                                                <td class="date align-middle fw-semibold text-end py-2 text-body-highlight">$256</td>
                                                                <td class="align-middle text-end white-space-nowrap pe-0 action py-2">
                                                                    <div class="btn-reveal-trigger position-static">
                                                                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                                                        <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                                                            <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                                                <td class="order align-middle white-space-nowrap py-2 ps-0"><a class="fw-semibold text-body-tertiary text-opacity-85 pointers-events-none text-decoration-none" href="#!">#2447</a></td>
                                                                <td class="status align-middle white-space-nowrap text-start fw-bold text-body-tertiary py-2"><span class="badge badge-phoenix fs-10 badge-phoenix-secondary"><span class="badge-label">Cancelled</span><span class="ms-1" data-feather="x" style="height:12.8px;width:12.8px;"></span></span></td>
                                                                <td class="delivery align-middle white-space-nowrap text-body py-2">Standard shipping</td>
                                                                <td class="total align-middle text-body-tertiary text-end py-2">Nov 10, 12:00 PM</td>
                                                                <td class="date align-middle fw-semibold text-end py-2 text-body-tertiary text-opacity-85">$898</td>
                                                                <td class="align-middle text-end white-space-nowrap pe-0 action py-2">
                                                                    <div class="btn-reveal-trigger position-static">
                                                                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                                                        <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                                                            <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                                                <td class="order align-middle white-space-nowrap py-2 ps-0"><a class="fw-semibold text-primary" href="#!">#2446</a></td>
                                                                <td class="status align-middle white-space-nowrap text-start fw-bold text-body-tertiary py-2"><span class="badge badge-phoenix fs-10 badge-phoenix-success"><span class="badge-label">shipped</span><span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;"></span></span></td>
                                                                <td class="delivery align-middle white-space-nowrap text-body py-2">Express</td>
                                                                <td class="total align-middle text-body-tertiary text-end py-2">Nov 12, 12:20 PM</td>
                                                                <td class="date align-middle fw-semibold text-end py-2 text-body-highlight">$4116</td>
                                                                <td class="align-middle text-end white-space-nowrap pe-0 action py-2">
                                                                    <div class="btn-reveal-trigger position-static">
                                                                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                                                        <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                                                            <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                                                <td class="order align-middle white-space-nowrap py-2 ps-0"><a class="fw-semibold text-body-tertiary text-opacity-85 pointers-events-none text-decoration-none" href="#!">#2445</a></td>
                                                                <td class="status align-middle white-space-nowrap text-start fw-bold text-body-tertiary py-2"><span class="badge badge-phoenix fs-10 badge-phoenix-success"><span class="badge-label">fulfilled</span><span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;"></span></span></td>
                                                                <td class="delivery align-middle white-space-nowrap text-body py-2">Free shipping</td>
                                                                <td class="total align-middle text-body-tertiary text-end py-2">Oct 19, 1:20 PM</td>
                                                                <td class="date align-middle fw-semibold text-end py-2 text-body-tertiary text-opacity-85">$4116</td>
                                                                <td class="align-middle text-end white-space-nowrap pe-0 action py-2">
                                                                    <div class="btn-reveal-trigger position-static">
                                                                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                                                        <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                                                            <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
                                                    <div class="col-auto d-flex">
                                                        <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p><a class="fw-semibold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a class="fw-semibold d-none" href="#!" data-list-view="less">View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                                                    </div>
                                                    <div class="col-auto d-flex">
                                                        <button class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                                                        <ul class="mb-0 pagination"></ul>
                                                        <button class="page-link pe-0" data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    </div>
                </div>
        </form>
    </div>

    <script src="{{ asset('assets/js/pages/sps/find.js') }}"></script>

@endsection

@push('script')
@endpush
