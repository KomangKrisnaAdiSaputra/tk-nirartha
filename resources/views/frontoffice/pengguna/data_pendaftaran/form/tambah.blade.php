@extends('layouts.pengguna-front')
@section('data')
    <style>
        .nice-select {
            margin-bottom: 5%;
            z-index: 2;
        }
    </style>
    <div class="col-lg-6 col-md-12 mx-auto">
        <div class="account-setting">
            <h6>Pendaftaran Awal</h6>
            <form action="{{ route('orangTua.update', session('firebaseUserId')) }}" method="POST"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <input type="hidden" value="pendaftaran_awal" name="type">
                <div class="col-12 mb-4">
                    <div class="form-group">
                        <label for="">Nama Siswa</label>
                        <select class="form-control" name="id_siswa" required>
                            <option selected>Nama Siswa</option>
                            @foreach ($data['siswa'] as $key => $value)
                                <option value="{{ $value['id_siswa'] }}">{{ $value['nama_siswa'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Catatan Pendaftaran Awal</label>
                        <textarea class="form-control" id="catatan_pendaftaran_awal" name="catatan_pendaftaran_awal" cols="20"
                            rows="5" placeholder="Catatan Pendaftaran Awal" required></textarea>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="form-group">
                        <label for="">Foto Bukti Pembayaran</label>
                        <input type="file" class="form-control form-control-user form-control-lg"
                            id="bukti_pembayaran_pendaftaran_awal" name="bukti_pembayaran_pendaftaran_awal"
                            accept="image/png, image/jpeg, image/jpg" required>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col d-flex justify-content-end">
                        <a href="{{ route('orangTua.pendaftaranSiswa') }}" type="button"
                            class="btn bg-outline-danger-modif" style="border: 2px solid red;">
                            Back</a>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <button type="submit" class="btn bg-outline-secondary-modif"
                            style="border: 2px solid #6c757d;">Simpan data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
