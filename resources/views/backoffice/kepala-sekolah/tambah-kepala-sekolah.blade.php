@extends('layouts.pengguna-back')
@section('main')
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Pengguna</h1>
                    <p class="mb-4">Keterangan halaman</p>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Pengguna</h6>
                        </div>
                        <div class="card-body d-grid d-lg-flex">
                            <div class="col-lg-5 text-center" id="canvas-foto-pengguna" style="border: 1px solid #d1d3e2;border-radius: 6px;">
                                <img src="{{ asset('back/img/undraw_profile.svg') }}" class="img-fluid rounded-4 py-2" id="img-foto-pengguna" alt="foto pengguna">
                            </div>
                            <div class="col-lg-7">
                                <input type="hidden" value="" id="">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="pb-3">
                                                <label for="input-foto-pengguna" class="form-label">Foto Pengguna</label>
                                                <input type="file" class="form-control" id="input-foto-pengguna" name="input-foto-pengguna">
                                                <div class="invalid-feedback" id="error-input-foto-pengguna">Foto pengguna tidak boleh kosong!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="input-tipe-pengguna">Tipe Pengguna</label>
                                                <input type="text" class="form-control" id="input-tipe-pengguna" name="input-tipe-pengguna" value="kepala sekolah">
                                                <div class="invalid-feedback" id="error-input-tipe-pengguna">Tipe pengguna tidak boleh kosong!</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="input-nama-pengguna">Nama Pengguna</label>
                                                <input type="text" class="form-control" id="input-nama-pengguna" name="input-nama-pengguna" value="">
                                                <div class="invalid-feedback" id="error-input-nama-pengguna">Nama pengguna tidak boleh kosong!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="input-username-pengguna">Username Pengguna</label>
                                                <input type="text" class="form-control" id="input-username-pengguna" name="input-username-pengguna">
                                                <div class="invalid-feedback" id="error-input-username-pengguna">Username pengguna tidak boleh kosong!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="input-password-pengguna">Password Pengguna</label>
                                                <input type="text" class="form-control" id="input-password-pengguna" name="input-password-pengguna">
                                                <div class="invalid-feedback" id="error-input-password-pengguna">Password pengguna tidak boleh kosong!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="input-gender-pengguna">Gender Pengguna</label>
                                                <select class="form-control" id="input-gender-pengguna" name="input-gender-pengguna">
                                                    <option selected disabled>Open this select menu</option>
                                                    <option value="1">Wanita</option>
                                                    <option value="2">Laki-laki</option>
                                                </select>
                                                <div class="invalid-feedback" id="error-input-gender-pengguna">Gender pengguna tidak boleh kosong!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="input-telepon-pengguna">Telepon Pengguna</label>
                                                <input type="number" class="form-control" id="input-telepon-pengguna" name="input-telepon-pengguna" value="">
                                                <div class="invalid-feedback" id="error-input-telepon">Telepon pengguna tidak boleh kosong!</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="input-alamat-pengguna">Alamat pengguna</label>
                                                <textarea class="form-control" id="input-alamat-pengguna" name="input-alamat-pengguna" cols="20" rows="5"></textarea>
                                                <div class="invalid-feedback" id="error-input-alamat-pengguna">Alamat pengguna tidak boleh kosong!</div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row justify-content-md-end">
                                        <div class="d-grid d-md-block gap-2">
                                            <a href=""><button class="btn btn-secondary" type="button">Kembali</button></a>
                                            <button class="btn btn-primary" type="button" id="btn-tambah-data-pengguna">Simpan</button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page content -->
@endsection