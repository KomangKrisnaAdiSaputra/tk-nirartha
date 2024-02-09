@extends('layouts.landing')

@section('main')
    <main>
        <!-- Section Start-->
        <section class="breadcrumb-area mt-15">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Galeri</li>
                            </ol>
                        </nav>
                        <h5>Galeri</h5>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section Start-->

        <!--Section Start -->
        <section class="banner-area pt-5">
            <div class="container-xl">
                <div class="row align-items-center mb-3">
                    <div class="col-12 col-lg-6 order-2 order-lg-1 px-2 canvas-img-galeri">
                        <img src="{{ asset('front/dist/images/beranda-1.jpg') }}" alt="banner-img" class="img-fluid rounded img-galeri">
                    </div>
                    <div class="col-12 col-lg-6 order-1 order-lg-2 px-2 canvas-img-galeri">
                        <img src="{{ asset('front/dist/images/beranda-1.jpg') }}" alt="banner-img" class="img-fluid rounded img-galeri">
                    </div>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col-12 col-lg-6 order-2 order-lg-1 px-2 canvas-img-galeri">
                        <img src="{{ asset('front/dist/images/beranda-1.jpg') }}" alt="banner-img" class="img-fluid rounded img-galeri">
                    </div>
                    <div class="col-12 col-lg-6 order-1 order-lg-2 px-2 canvas-img-galeri">
                        <img src="{{ asset('front/dist/images/beranda-1.jpg') }}" alt="banner-img" class="img-fluid rounded img-galeri">
                    </div>
                </div>
                <div class="row align-items-center mb-5">
                    <div class="col-12 col-lg-6 order-2 order-lg-1 px-2 canvas-img-galeri">
                        <img src="{{ asset('front/dist/images/beranda-1.jpg') }}" alt="banner-img" class="img-fluid rounded img-galeri">
                    </div>
                    <div class="col-12 col-lg-6 order-1 order-lg-2 px-2 canvas-img-galeri">
                        <img src="{{ asset('front/dist/images/beranda-1.jpg') }}" alt="banner-img" class="img-fluid rounded img-galeri">
                    </div>
                </div>
            </div>
        </section>
        <!--Section End -->
    </main>
@endsection