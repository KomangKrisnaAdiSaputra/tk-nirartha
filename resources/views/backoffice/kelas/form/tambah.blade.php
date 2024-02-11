@extends('layouts.pengguna-back')
@section('main')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Form</h1>
        <p class="mb-4">Form Tambah {{ ucwords($menu) }}</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah {{ ucwords($menu) }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('kelas.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                    name="nama_kelas" placeholder="Nama Kelas" required>
                                <div class="invalid-feedback">
                                    error
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control" id="catatan_kelas" name="catatan_kelas" cols="20" rows="5"
                                    placeholder="Isi Pengumuman" required></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <select class="form-control" name="status_kelas" required>
                                    <option selected disabled>Status</option>
                                    <option value="1">Aktif
                                    </option>
                                    <option value="0">
                                        Non-Aktif</option>
                                </select>
                                <div class="invalid-feedback" id="error-input-gender-pengguna">Gender pengguna tidak boleh
                                    kosong!</div>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex pr-0 justify-content-end">
                        <a href="{{ route('pengumuman.index') }}" class="btn bg-outline-secondary-modif mr-3">Kembali</a>
                        <button type="submit" class="btn bg-primary text-white">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
