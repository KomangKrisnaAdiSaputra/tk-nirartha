@extends('layouts.landing')

@section('main')
    <main>
        <!-- Histori Area Start -->
        <section class="about-area pt-5">
            <div class="container">
                <div class="about-area-content">
                    <div class="row align-items-center">
                        <div class="col-lg-7">
                            <div class="about-area-content-text">
                                <h3>Profil TK Kumaran II</h3>
                                <p style="text-align: justify;">
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quae illo, obcaecati
                                    voluptates laudantium ducimus placeat praesentium aliquid aspernatur commodi veritatis
                                    non explicabo, nihil voluptatum amet sint dolorem corporis consectetur culpa?
                                    Nesciunt consequatur esse molestias, aspernatur doloribus fugit tenetur tempore earum
                                    dolor debitis, incidunt ipsum mollitia est. Debitis, modi dolores iste asperiores
                                    laborum et! Nam voluptatibus laboriosam cupiditate fugiat vitae inventore!
                                    Aut aliquid beatae at nihil excepturi delectus repellendus rerum earum dolorum, sit
                                    iusto minima nostrum veniam voluptatum iure vel modi sunt nulla fuga, aliquam harum
                                    reiciendis voluptate corrupti! Ipsa, minima?
                                    Reprehenderit ad nam veniam, explicabo maxime culpa quam nostrum inventore.
                                    Reprehenderit dolor, dolore adipisci quibusdam doloremque aliquam corrupti libero enim
                                    distinctio obcaecati provident placeat quidem mollitia tempora sint tempore modi.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="about-area-content-img">
                                <img src="dist/images/beranda-2.jpg" class="img-fluid" alt=""
                                    style="border-radius: 86px 24px 0 24px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Histori Area End -->
        <!-- About Area Start -->
        <section class="populerproduct pt-5">
            <div class="container">
                <div class="about-area-content">
                    <div class="row align-items-center position-relative">
                        <div class="col-lg-6 ">
                            <div class="about-area-content-img">
                                <img src="{{ asset('front/dist/images/beranda-2.jpg') }}" alt="img" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="about-area-content-text">
                                <h3>Visi </h3>
                                <p style="text-align: justify;">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cumque expedita earum
                                    accusamus illum modi tempore, adipisci aspernatur in illo vitae quisquam. Nulla eaque
                                    amet ea accusantium sed doloribus porro non.
                                </p>
                                <h3>Misi</h3>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Area End -->

        <!-- Section Start -->
        {{-- <section class="customersreview">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 mt-4">
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
