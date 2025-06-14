@extends('spss.layout.customer_template')
@section('main')

<div class="container text-center">

        <div class="row flex-center min-vh-100 py-5">

            <div class="col-sm-10 col-md-8 col-lg-5 col-xl-5 col-xxl-3"><a class="d-flex flex-center text-decoration-none mb-4" href="../../../index.html">
                    {{-- <div class="d-flex align-items-center fw-bolder fs-3 d-inline-block"><img src="../../../assets/img/icons/logo.png" alt="phoenix" width="58" />
                    </div> --}}
                </a>

                <div class="card shadow-sm">
                    <div class="card-body p-4 p-sm-5">
                        <div class="text-center mb-4">
                            <img src="{{asset('assets/img/icons/logo-placeholder.jpg')}}" alt="phoenix" width="58" />
                        </div>
                        <div class="text-center mb-7">
                            <h3 class="text-body-highlight">SPS</h3>
                            <p class="text-body-tertiary">Confirmation details.</p>
                        </div>
                        <div class="card p-4">
                            <h3>{{ $profile->first_name }} {{ $profile->last_name }}</h3>
                            <p><strong>Refernce#:</strong> {{ $profile->ref_number ?? $profile->id }}</p>
                            <p><strong>Phone:</strong> {{ $profile->phone }}</p>
                            <p><strong>email:</strong> {{ $profile->email_address }}</p>
                    
                            <div class="mt-4">
                                <h5>QR Code:</h5>
                                {{-- {!! QrCode::size(200)->generate($profile->ref_number) !!} --}}
                    
                                <img src="data:image/png;base64,{{ $qrBase64 }}" alt="QR Code" width="200">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</div>
@endsection

@push('script')


@endpush