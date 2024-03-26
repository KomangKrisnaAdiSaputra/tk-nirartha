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
                                <li class="breadcrumb-item active" aria-current="page">Pengumuman</li>
                            </ol>
                        </nav>
                        <h5>Pengumuman</h5>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section Start-->

        <!-- Section Star -->
        <!--Banner Area End -->
        @if (count($pengumuman) > 0)
            <!-- Section Start -->
            <section class="features">
                <div class="container">
                    <div class="features-wrapper">
                        <div class="features-active">
                            @foreach ($pengumuman as $key => $value)
                                <div class="product-item">
                                    <div class="product-item-image">
                                        <a href="#"><img
                                                src="{{ asset('front/dist/images/pengumuman/pengumuman-1.jpg') }}"
                                                alt="Product Name" class="img-fluid"></a>
                                        <div class="cart-icon">
                                            <a href="#"><i class="fas fa-search"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-item-info">
                                        <a href="#">{{ $value['isi_pengumuman'] }}</a>
                                        <div class="d-flex sectionPengumuman-profilUser">
                                            <i class="fa fa-user"></i>
                                            <div class="d-grid ml-2">
                                                <p>Admin</p>
                                                <p>{{ carbon(true, $value['tgl_pengumuman'], 'Y-m-d', 'd F Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                        <div class="slider-arrows">
                            <div class="prev-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="9.414" height="16.828"
                                    viewBox="0 0 9.414 16.828">
                                    <path id="Icon_feather-chevron-left" data-name="Icon feather-chevron-left"
                                        d="M20.5,23l-7-7,7-7" transform="translate(-12.5 -7.586)" fill="none"
                                        stroke="#1a2224" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                </svg>
                            </div>
                            <div class="next-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="9.414" height="16.828"
                                    viewBox="0 0 9.414 16.828">
                                    <path id="Icon_feather-chevron-right" data-name="Icon feather-chevron-right"
                                        d="M13.5,23l5.25-5.25.438-.437L20.5,16l-7-7" transform="translate(-12.086 -7.586)"
                                        fill="none" stroke="#1a2224" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                 <div class="col-sm-12">
                     <div class="features-morebutton text-center">
                         <a class="btn bt-glass" href="#">Semua Pengumuman</a>
                     </div>
                 </div>
             </div> --}}
                </div>
            </section>
            <!-- Section End -->
        @endif
        <!-- Section End -->

    </main>
@endsection
