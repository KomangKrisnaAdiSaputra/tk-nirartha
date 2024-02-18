@extends('layouts.pengguna-front')
@section('data')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Form</h1>
        <p class="mb-4">Form Pembayaran Siswa</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pembayaran Siswa</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('orangTua.update', session('firebaseUserId')) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" value="data_pembayaran" name="type">
                    <input type="hidden" value="{{ $data['pembayaran']['id_biaya'] }}" name="id_biaya">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Nama Siswa</label>
                                <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                    name="nama_siswa" placeholder="Nama Siswa"
                                    value="{{ getDataSiswa($data['pembayaran']['id_siswa'])['nama_siswa'] }}" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Nama Biaya</label>
                                <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                    name="nama_biaya" placeholder="Nama Biaya"
                                    value="{{ $data['pembayaran']['nama_biaya'] }}" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Bulan & Tahun</label>
                                <input type="month" class="form-control form-control-user form-control-lg fs-6"
                                    name="bulan&tahun"
                                    value="{{ $data['pembayaran']['tahun_biaya'] . '-' . $data['pembayaran']['bulan_biaya'] }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Foto Pembayaran</label>
                                <input type="file" class="form-control form-control-user form-control-lg"
                                    id="foto_pembayaran" name="foto_pembayaran" accept="image/png, image/jpeg, image/jpg"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex pr-0 justify-content-end">
                        <a href="{{ route('orangTua.dataPembayaranSiswa') }}"
                            class="btn bg-outline-secondary-modif mr-3">Kembali</a>
                        <button type="submit" class="btn bg-primary text-white">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
