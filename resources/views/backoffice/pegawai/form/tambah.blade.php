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
                <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                    placeholder="Username" name="username_user" value="" required>
                                <div class="invalid-feedback">
                                    error
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                    placeholder="Email" name="email_user" value="" required>
                                <div class="invalid-feedback">
                                    error
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user form-control-lg fs-6"
                                    placeholder="Password" name="password_user" value="" required>
                                <div class="invalid-feedback">
                                    error
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user form-control-lg fs-6"
                                    placeholder="Konfirmasi Password" name="konfirmasi_password_user" value=""
                                    required>
                                <div class="invalid-feedback">
                                    error
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="number" class="form-control form-control-user form-control-lg fs-6"
                                    placeholder="No Telepon" name="telp_pegawai" value="" required>
                                <div class="invalid-feedback">
                                    error
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <select class="form-control" name="jk_pegawai" required>
                                    <option selected disabled>Jenis Kelamin</option>
                                    <option value="1">Wanita</option>
                                    <option value="2">Laki-laki</option>
                                </select>
                                <div class="invalid-feedback" id="error-input-gender-pengguna">Gender pengguna tidak boleh
                                    kosong!</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="file" class="form-control" id="input-foto-pengguna" name="foto_pegawai"
                                    placeholder="Foto">
                                <div class="invalid-feedback" id="error-input-foto-pengguna">Foto pengguna tidak boleh
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
