@extends('spss.layout.customer_template')
@section('main')

    <div class="container">
        <form method="POST" action="{{ route('visitor.store') }}" class="forms-sample">
            @csrf
            <input type="hidden" name="venue" value="LUS">
            <div class="row flex-center min-vh-100 py-5">

                <div class="col-sm-10 col-md-8 col-lg-5 col-xl-5 col-xxl-3"><a
                        class="d-flex flex-center text-decoration-none mb-4" href="../../../index.html">
                        {{-- <div class="d-flex align-items-center fw-bolder fs-3 d-inline-block"><img src="../../../assets/img/icons/logo.png" alt="phoenix" width="58" />
                            </div> --}}
                    </a>

                    <div class="card shadow-sm">
                        <div class="card-body p-4 p-sm-5">
                            <div class="text-center mb-4">
                                <img src="{{ asset('assets/img/icons/logo-placeholder.jpg') }}" alt="phoenix"
                                    width="58" />
                            </div>
                            <div class="text-center mb-7">
                                <h3 class="text-body-highlight">SPS</h3>
                                <p class="text-body-tertiary">All fields are required.</p>
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
                            <!-- <button class="btn btn-phoenix-secondary w-100 mb-3"><span class="fab fa-google text-danger me-2 fs-9"></span>Sign in with google</button>
                                        <button class="btn btn-phoenix-secondary w-100"><span class="fab fa-facebook text-primary me-2 fs-9"></span>Sign in with facebook</button>
                                        <div class="position-relative">
                                        <hr class="bg-body-secondary mt-5 mb-4" />
                                        <div class="divider-content-center">or use email</div>
                                        </div> -->
                            <x-formy.form_input class="mb-3 text-start" floating="1" inputValue="" name="first_name"
                                elementId="add_first_name" inputType="text" inputAttributes="" label="First Name"
                                required="required" disabled="0" />

                            <x-formy.form_input class="mb-3 text-start" floating="1" inputValue="" name="last_name"
                                elementId="add_last_name" inputType="text" inputAttributes="" label="Last Name"
                                required="required" disabled="0" />
                            <x-formy.form_input class="mb-3 text-start" floating="1" inputValue="" name="email_address"
                                elementId="add_email_address" inputType="email" inputAttributes="" label="Email"
                                required="required" disabled="0" />
                            <x-formy.form_input class="mb-3 text-start" floating="1" inputValue="" name="phone"
                                elementId="add_phone" inputType="phone" inputAttributes="" label="Phone Number"
                                required="required" disabled="0" />
                            <div class="mb-3 text-start">
                            <x-formy.href_insert_js table="x" selectionId="add-item" dataId="0"
                                title="Add Item" buttonClass="btn btn-subtle-primary px-3 w-100 px-sm-5 " icon="fa-solid fa-plus me-2" />
                            </div>
                            <div id="visitor_items_container" class="mb-3 text-start"></div>
                            {{-- <x-formy.form_select class="mb-3 text-start" floating="1" selectedValue=""
                                name="prohibited_item_id" elementId="add_prohibited_item" label="Item Category"
                                required="required" :forLoopCollection="$prohibitedItems" itemIdForeach="id" itemTitleForeach="item_name"
                                style="" addDynamicButton="0" />
                            <x-formy.form_textarea class="mb-3 text-start" floating="1" inputValue=""
                                name="item_description" elementId="add_item_description" inputType="text" inputAttributes=""
                                label="Item Description" required="required" disabled="0" /> --}}

                            {{-- <div class="mb-3 text-start">
                            <label class="form-label" for="email">First Name</label>
                            <div class="form-icon-container">
                                <input class="form-control form-icon-input" name="first_name" type="text" /><span class="fas fa-user text-body fs-9 form-icon"></span>
                            </div>
                        </div>

                        <div class="mb-3 text-start">
                            <label class="form-label" for="email">Last Name</label>
                            <div class="form-icon-container">
                                <input class="form-control form-icon-input" name="last_name" type="text" /><span class="fas fa-user text-body fs-9 form-icon"></span>
                            </div>
                        </div>

                        <div class="mb-3 text-start">
                            <label class="form-label" for="email">Email</label>
                            <div class="form-icon-container">
                                <input class="form-control form-icon-input" name="email_address" type="email" /><span class="fas fa-envelope text-body fs-9 form-icon"></span>
                            </div>
                        </div>

                        <div class="mb-3 text-start">
                            <label class="form-label" for="email">Phone Number</label>
                            <div class="form-icon-container">
                                <input class="form-control form-icon-input" name="phone" type="phone" /><span class="fas fa-phone text-body fs-9 form-icon"></span>
                            </div>
                        </div> --}}
                            <button class="btn btn-primary w-100 mb-3">Save</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>

    <script>
            $("body").on("click", "#add-item", function () {
         console.log('inside add_item')
          var addBtn, html, rowCount, tableBody;
          rowCount = $("#visitor_items_container").children().length+1;
          console.log("rowCount: " + rowCount);
         html = ``;
            html += '    <div class="col-sm-6 col-md-12 mb-3">'
             html += '    <div class="input-group">'
             html += '     <div class="form-floating">'
            html += '        <select name="prohibited_item_id[]"'
            html += '           class="form-select form-select-sm item_selected" '
            html += '           id="prohibited_item_id_' + rowCount + '"'
            html += '           required>'
            html += '        <option selected="selected" value="">Select...</option>'
            html += '        @foreach ($prohibitedItems as $key => $item)'
            html += '            <option value="{{ $item->id }}">'
            html += '                {{ $item->item_name }}'
            html += '            </option>'
            html += '        @endforeach'
            html += '        </select>'
            html += '    <div class="invalid-feedback">'
            html += '        Please select item.'
            html += '    </div>'
            html += '<label for="add_prohibited_item">Item Category</label>'
            html += '    </div>'
            html += '    </div>'
            html += '    </div>'

    html += '        <div class="mb-3 text-start">'
    html += '           <div class="form-floating">'
    html += '               <textarea name="item_description[]" class="form-control" id="add_item_description' + rowCount + '" placeholder="Item Description" style="height: 100px" required="" 0=""></textarea>'
    html += '               <label for="add_item_description">Item Description</label>'
    html += '          </div>'
    html += '       </div>'
    html += '       <hr>'
         $('#visitor_items_container').append(html);

    });
        </script>
{{-- @include('spss.modals.storage_modals') --}}

@endsection


@push('script')
<script src="{{ asset('assets/js/pages/sps/visitor_items.js') }}"></script>
@endpush
