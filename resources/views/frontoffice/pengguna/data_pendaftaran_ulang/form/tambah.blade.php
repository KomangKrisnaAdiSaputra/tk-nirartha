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
            <h6>Pendaftaran Ulang</h6>
            <form action="{{ route('orangTua.update', session('firebaseUserId')) }}" method="POST"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <input type="hidden" value="pendaftaran_ulang" name="type">
                <div class="col-12 mb-4">
                    <div class="form-group">
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
                        <textarea class="form-control" id="catatan_pendaftaran_ulang" name="catatan_pendaftaran_ulang" cols="20"
                            rows="5" placeholder="Catatan Pendaftaran Ulang" required></textarea>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="form-group">
                        <input type="file" class="form-control form-control-user form-control-lg"
                            id="bukti_pembayaran_pendaftaran_ulang" name="bukti_pembayaran_pendaftaran_ulang"
                            accept="image/png, image/jpeg, image/jpg" required>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col d-flex justify-content-end">
                        <a href="{{ route('orangTua.pendaftaranUlangSiswa') }}" type="button"
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