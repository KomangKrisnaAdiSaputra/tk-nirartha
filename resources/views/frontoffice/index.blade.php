@extends('layouts.landing')

@section('main')
    <main>
        <!--Banner Area Start -->
        <section class="banner-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 order-2 order-lg-1">
                        <div class="banner-area__content">
                            <h2>Prioritas Tepat Masa Depan Cerah.</h2>
                            <p>Menghadirkan masa depan yang cerah, manjadi tujuan utama kami bagi putra dan putri anda.</p>
                            {{-- <a class="btn bg-primary" href="#">Pendaftaran</a> --}}
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2">
                        <div class="banner-area__img">
                            <img src="{{ asset('image/landingPages/Gambar1.jpg') }}" alt="banner-img" class="img-fluid">
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!--Banner Area End -->
        @if (count($pengumuman) > 0)
            <!-- Section Start -->
            <section class="features">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="section-title">
                                <h2>Pengumuman</h2>
                            </div>
                        </div>
                    </div>
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

        <!-- Section Start -->
        <section class="about-area">
            <div class="container">
                <div class="about-area-content">
                    <div class="row align-items-center">
                        <div class="col-lg-6 ">
                            <div class="about-area-content-img">
                                <img src="{{ asset('image/landingPages/Gambar3.jpg') }}" alt="img" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="about-area-content-text">
                                <h3>TK Kumaran II</h3>
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto minus aliquam maxime
                                    tenetur magni, quia, nesciunt facilis totam recusandae magnam hic cupiditate,
                                    reprehenderit accusantium vitae sunt perspiciatis sit! Fugit, ex?.</p>
                                <div class="icon-area-content">
                                    <div class="icon-area">
                                        <i class="far fa-check-circle"></i>
                                        <span>Tenaga pengajar yang profesional.</span>
                                    </div>
                                    <div class="icon-area">
                                        <i class="far fa-check-circle"></i>
                                        <span>Lingkungan sekolah yang sehat.</span>
                                    </div>
                                    <div class="icon-area">
                                        <i class="far fa-check-circle"></i>
                                        <span>Kurikulum yang menyenangkan</span>
                                    </div>
                                    <div class="icon-area">
                                        <i class="far fa-check-circle"></i>
                                        <span>Fasilitas yang lengkap.</span>
                                    </div>
                                </div>

                                {{-- <a class="btn bg-primary" href="#">Pendaftaran</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section End -->

        <!-- Section Strat -->
        {{-- <section class="populerproduct">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-title">
                            <h2>Kegiatan</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="product-item">
                            <div class="product-item-image">
                                <a href="#"><img src="{{ asset('front/dist/images/kegiatan/kegiatan-1.jpg') }}" alt="Product Name"
                                        class="img-fluid"></a>
                                <div class="cart-icon">
                                    <a href="#"><i class="fas fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-item-info">
                                <a href="#">Perayaan Hari Pahlawan</a>
                                <div class="d-flex sectionPengumuman-profilUser">
                                    <i class="fa fa-user"></i>
                                    <div class="d-grid ml-2">
                                        <p>Admin</p>
                                        <p>12 Maret 2023</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="product-item">
                            <div class="product-item-image">
                                <a href="#"><img src="{{ asset('front/dist/images/kegiatan/kegiatan-1.jpg') }}" alt="Product Name"
                                        class="img-fluid"></a>
                                <div class="cart-icon">
                                    <a href="#"><i class="fas fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-item-info">
                                <a href="#">Perayaan Hari Pahlawan</a>
                                <div class="d-flex sectionPengumuman-profilUser">
                                    <i class="fa fa-user"></i>
                                    <div class="d-grid ml-2">
                                        <p>Admin</p>
                                        <p>12 Maret 2023</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="product-item">
                            <div class="product-item-image">
                                <a href="#"><img src="{{ asset('front/dist/images/kegiatan/kegiatan-1.jpg') }}" alt="Product Name"
                                        class="img-fluid"></a>
                                <div class="cart-icon">
                                    <a href="#"><i class="fas fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-item-info">
                                <a href="#">Perayaan Hari Pahlawan</a>
                                <div class="d-flex sectionPengumuman-profilUser">
                                    <i class="fa fa-user"></i>
                                    <div class="d-grid ml-2">
                                        <p>Admin</p>
                                        <p>12 Maret 2023</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="features-morebutton text-center">
                            <a class="btn bt-glass" href="#">Semua Kegiatan</a>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- Section End -->

        @if (count($pegawai) > 0)
            <!-- Section Start -->
            <section class="categorys">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="section-title">
                                <h2>Pengajar</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($pegawai as $key => $value)
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                <div class="productcategory text-center">
                                    <div class="productcategory-img">
                                        <a href="#">
                                            @if (
                                                $value['foto_pegawai'] == '' ||
                                                    $value['foto_pegawai'] == null ||
                                                    file_exists(getcwd() . '/image/fotoPegawai/' . $value['foto_pegawai']) != 1)
                                                <img src="{{ asset('front/dist/images/profil-guru/profil-1.jpg') }}"
                                                    style="width: 200px;" alt="images">
                                            @else
                                                <img src="{{ asset('image/fotoPegawai/' . $value['foto_pegawai']) }}"
                                                    style="width: 200px;" alt="images">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="productcategory-text">
                                        <a href="#">
                                            <h6>{{ $value['nama_pegawai'] }}</h6>
                                            {{-- <span>Mulai Berkarya 01 Oktober 2023</span> --}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <!-- Section End -->
        @endif

        <!-- Section Start -->
        {{-- <section class="customersreview">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-title">
                            <h2>Pendapat Orang Tua</h2>
                        </div>
                    </div>
                </div>
                <div class="customersreview-wrapper">
                    <div class="customersreview-active">
                        <div class="customersreview-item">
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odit beatae accusamus aliquam veritatis dicta, magnam quas aperiam qui, neque omnis saepe non ipsa sit atque velit est. In, aut porro..</p>
                            <div class="name">
                                <h6>Nanda Krisna</h6>
                                <span>Pegawai Swasta</span>
                            </div>
                        </div>
                        <div class="customersreview-item">
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odit beatae accusamus aliquam veritatis dicta, magnam quas aperiam qui, neque omnis saepe non ipsa sit atque velit est. In, aut porro..</p>
                            <div class="name">
                                <h6>Nanda Krisna</h6>
                                <span>Pegawai Swasta</span>
                            </div>
                        </div>
                        <div class="customersreview-item">
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odit beatae accusamus aliquam veritatis dicta, magnam quas aperiam qui, neque omnis saepe non ipsa sit atque velit est. In, aut porro..</p>
                            <div class="name">
                                <h6>Nanda Krisna</h6>
                                <span>Pegawai Swasta</span>
                            </div>
                        </div>
                        <div class="customersreview-item">
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odit beatae accusamus aliquam veritatis dicta, magnam quas aperiam qui, neque omnis saepe non ipsa sit atque velit est. In, aut porro..</p>
                            <div class="name">
                                <h6>Nanda Krisna</h6>
                                <span>Pegawai Swasta</span>
                            </div>
                        </div>
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
            </div>
        </section> --}}
        <!-- Section End -->
    </main>
@endsection
