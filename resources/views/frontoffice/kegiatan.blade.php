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
                                <li class="breadcrumb-item active" aria-current="page">Kegiatan</li>
                            </ol>
                        </nav>
                        <h5>Kegiatan</h5>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section Start-->

        <!-- Section Star -->
        <section class="populerproduct">
            <div class="container">
                <div class="row">
                    @foreach ($kegiatan as $key => $value)
                        <div class="col-md-4 col-sm-6">
                            <div class="product-item">
                                <div class="product-item-image">
                                    <img src="{{ $value['image'] }}" alt="Product Name" class="img-fluid"
                                        style="height: 300px; object-fit: cover; width: 100%;">
                                    {{-- <div class="cart-icon">
                                    <a href="detail-kegiatan.html"><i class="fas fa-search"></i></a>
                                </div> --}}
                                </div>
                                <div class="product-item-info">
                                    <a href="detail-kegiatan.html">{{ $value['title'] }}</a>
                                    <div class="d-flex sectionPengumuman-profilUser">
                                        <i class="fa fa-user"></i>
                                        <div class="d-grid ml-2">
                                            <p>{{ $value['author'] }}</p>
                                            <p>{{ $value['date'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Section End -->

    </main>
@endsection
