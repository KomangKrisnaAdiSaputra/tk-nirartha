@extends('layouts.pengguna-back')
@section('main')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Form</h1>
        <p class="mb-4">Form Tambah {{ ucwords($menu) }}</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit {{ ucwords($menu) }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('pegawai.update', $dataPegawai['id_pegawai']) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Username User</label>
                                <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                    placeholder="Username" name="username_user" value="{{ $dataPegawai['nama_pegawai'] }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Email User</label>
                                <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                    placeholder="Email" name="email_user" value="{{ $dataUserPegawai['email_user'] }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Password User</label>
                                <input type="password" class="form-control form-control-user form-control-lg fs-6"
                                    placeholder="Password" name="password_user" id="password_user" value=""
                                    onchange="validasiPass()">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Konfirmasi Password User</label>
                                <input type="password" class="form-control form-control-user form-control-lg fs-6"
                                    placeholder="Konfirmasi Password" name="konfirmasi_password_user"
                                    id="konfirmasi_password_user" value="" onchange="validasiPass()">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Telepon Pegawai</label>
                                <input type="number" class="form-control form-control-user form-control-lg fs-6"
                                    placeholder="No Telepon" name="telp_pegawai" value="{{ $dataPegawai['telp_pegawai'] }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <select class="form-control" name="jk_pegawai" required>
                                    <option value="" selected disabled>Jenis Kelamin</option>
                                    @foreach ($jenis_kelamin as $key => $value)
                                        <option value="{{ $value['key'] }}"
                                            {{ $dataPegawai['jk_pegawai'] === $value['key'] ? 'selected' : '' }}>
                                            {{ $value['value'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Foto Pegawai</label>
                                <input type="file" class="form-control" name="foto_pegawai" placeholder="Foto">
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex pr-0 justify-content-end">
                        <a href="{{ route('pegawai.index') }}" class="btn bg-outline-secondary-modif mr-3">Kembali</a>
                        <button type="submit" class="btn bg-primary text-white" id="btn_simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
