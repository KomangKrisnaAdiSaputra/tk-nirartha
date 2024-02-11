@extends('layouts.pengguna-front')
@section('data')
    <div class="col px-0 mt-0 mb-4 d-flex justify-content-end">
        <a class="btn bg-primary px-3 pt-3" href="form-pendaftaran-siswa.html">Form Pendaftaran</a>
    </div>
    <div class="col-lg-12">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Pendaftaran Ramadan Nandan Harto
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="cart-items">
                            <div class="header">
                                <div class="col-4 col-md-2 px-2">
                                    Foto
                                </div>
                                <div class="col-8 col-md-10 px-0">
                                    <div class="row mx-0 d-grid d-md-flex">
                                        <div class="col-5 px-2">
                                            Nama Siswa
                                        </div>
                                        <div class="col-3 px-2">
                                            Tanggal Daftar
                                        </div>
                                        <div class="col-2 px-2">
                                            Status Daftar
                                        </div>
                                        <div class="col-2 px-2">
                                            Status Transaksi
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="body">
                                <div class="item">
                                    <div class="col-4 col-md-2 px-0 px-md-3">
                                        <img src="../../public/images/foto_anak/sampel.jpeg" class="img-fluid rounded"
                                            alt="foto siswa">
                                    </div>
                                    <div class="col-8 col-md-10 px-0">
                                        <div class="row mx-0 d-grid d-md-flex">
                                            <div class="col-12 col-md-5 px-3 px-md-2">
                                                <h5>Ramadan Nandan Harto</h5>
                                                <div class="col px-0 mt-3 d-none d-md-block justify-content-center">
                                                    <a class="btn bg-outline-primary-modif px-3 pt-3"
                                                        href="detail-pendaftaran-siswa.html">Detail Pendaftaran</a>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3 px-3 px-md-2 mt-3 mt-md-0">
                                                <span>Daftar, 17 Maret 2023</del>
                                            </div>
                                            <div class="col-12 col-md-2 px-3 px-md-2 mt-1 mt-md-0">
                                                <span class="badge rounded-pill bg-primary px-2">Verifikasi Daftar</span>
                                            </div>
                                            <div class="col-12 col-md-2 px-3 px-md-2 mt-1 mt-md-0">
                                                <span class="badge rounded-pill bg-primary px-2">Verifikasi Transaksi</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col px-0 d-flex d-md-none mt-4 justify-content-end">
                                        <a class="btn bg-primary" href="detail-pendaftaran-siswa.html">Detail
                                            Pendaftaran</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Pendaftaran Siswa
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="cart-items">
                            <div class="header">
                                <div class="col-4 col-md-2 px-2">
                                    Foto
                                </div>
                                <div class="col-8 col-md-10 px-0">
                                    <div class="row mx-0 d-grid d-md-flex">
                                        <div class="col-5 px-2">
                                            Nama Siswa
                                        </div>
                                        <div class="col-3 px-2">
                                            Tanggal Daftar
                                        </div>
                                        <div class="col-2 px-2">
                                            Status Daftar
                                        </div>
                                        <div class="col-2 px-2">
                                            Status Transaksi
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="body">
                                <div class="item">
                                    <div class="col-4 col-md-2 px-0 px-md-3">
                                        <img src="../../public/images/foto_anak/sampel.jpeg" class="img-fluid rounded"
                                            alt="foto siswa">
                                    </div>
                                    <div class="col-8 col-md-10 px-0">
                                        <div class="row mx-0 d-grid d-md-flex">
                                            <div class="col-12 col-md-5 px-3 px-md-2">
                                                <h5>Ramadan Nandan Harto</h5>
                                                <div class="col px-0 mt-3 d-none d-md-block justify-content-center">
                                                    <a class="btn bg-outline-primary-modif px-3 pt-3"
                                                        href="detail-pendaftaran-siswa.html">Detail Pendaftaran</a>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3 px-3 px-md-2 mt-3 mt-md-0">
                                                <span>Daftar, 17 Maret 2023</del>
                                            </div>
                                            <div class="col-12 col-md-2 px-3 px-md-2 mt-1 mt-md-0">
                                                <span class="badge rounded-pill bg-primary px-2">Verifikasi Daftar</span>
                                            </div>
                                            <div class="col-12 col-md-2 px-3 px-md-2 mt-1 mt-md-0">
                                                <span class="badge rounded-pill bg-primary px-2">Verifikasi Transaksi</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col px-0 d-flex d-md-none mt-4 justify-content-end">
                                        <a class="btn bg-primary" href="billing-information.html">Detail Pendaftaran</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        Pendaftaran Siswa
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="cart-items">
                            <div class="header">
                                <div class="col-4 col-md-2 px-2">
                                    Foto
                                </div>
                                <div class="col-8 col-md-10 px-0">
                                    <div class="row mx-0 d-grid d-md-flex">
                                        <div class="col-5 px-2">
                                            Nama Siswa
                                        </div>
                                        <div class="col-3 px-2">
                                            Tanggal Daftar
                                        </div>
                                        <div class="col-2 px-2">
                                            Status Daftar
                                        </div>
                                        <div class="col-2 px-2">
                                            Status Transaksi
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="body">
                                <div class="item">
                                    <div class="col-4 col-md-2 px-0 px-md-3">
                                        <img src="../../public/images/foto_anak/sampel.jpeg" class="img-fluid rounded"
                                            alt="foto siswa">
                                    </div>
                                    <div class="col-8 col-md-10 px-0">
                                        <div class="row mx-0 d-grid d-md-flex">
                                            <div class="col-12 col-md-5 px-3 px-md-2">
                                                <h5>Ramadan Nandan Harto</h5>
                                                <div class="col px-0 mt-3 d-none d-md-block justify-content-center">
                                                    <a class="btn bg-outline-primary-modif px-3 pt-3"
                                                        href="detail-pendaftaran-siswa.html">Detail Pendaftaran</a>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3 px-3 px-md-2 mt-3 mt-md-0">
                                                <span>Daftar, 17 Maret 2023</del>
                                            </div>
                                            <div class="col-12 col-md-2 px-3 px-md-2 mt-1 mt-md-0">
                                                <span class="badge rounded-pill bg-primary px-2">Verifikasi Daftar</span>
                                            </div>
                                            <div class="col-12 col-md-2 px-3 px-md-2 mt-1 mt-md-0">
                                                <span class="badge rounded-pill bg-primary px-2">Verifikasi
                                                    Transaksi</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col px-0 d-flex d-md-none mt-4 justify-content-end">
                                        <a class="btn bg-primary" href="billing-information.html">Detail Pendaftaran</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
