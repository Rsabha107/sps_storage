@extends('spss.layout.admin_template')
@section('main')
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->

    <!-- <div class="content"> -->
    <!-- <div class="container-fluid"> -->
    <div class="d-flex justify-content-between m-2">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active"> List Items </li>
                </ol>
            </nav>
        </div>
        <div>
            {{-- <x-formy.button url="#" title="Store New Item" icon="fa-solid fa-plus"
                class="btn btn-subtle-primary px-3 px-sm-5 me-2" /> --}}
            <x-formy.button_insert_js title='Store New Item' selectionId="offcanvas-add-stored-item" dataId="0"
                table="storage_table" />

            <button class="btn px-3 btn-phoenix-secondary" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#bookingFilterOffcanvas" aria-haspopup="true" aria-expanded="false"
                data-bs-reference="parent"><svg class="svg-inline--fa fa-filter text-primary" data-fa-transform="down-3"
                    aria-hidden="true" focusable="false" data-prefix="fas" data-icon="filter" role="img"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""
                    style="transform-origin: 0.5em 0.6875em;">
                    <g transform="translate(256 256)">
                        <g transform="translate(0, 96)  scale(1, 1)  rotate(0 0 0)">
                            <path fill="currentColor"
                                d="M3.9 54.9C10.5 40.9 24.5 32 40 32H472c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9V448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6V320.9L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z"
                                transform="translate(-256 -256)"></path>
                        </g>
                    </g>
                </svg><!-- <span class="fa-solid fa-filter text-primary" data-fa-transform="down-3"></span> Font Awesome fontawesome.com -->
            </button>
        </div>
    </div>

    @include('spss.modals.storage_modals')

    <x-storage-card />
    <!-- </div> -->

    <script src="{{ asset('assets/js/pages/sps/items.js') }}"></script>
@endsection

@push('script')
@endpush
