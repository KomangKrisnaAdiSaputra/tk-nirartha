@extends('layouts.pengguna-back')
@section('main')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Form</h1>
        <p class="mb-4">Form {{ ucwords($menu) }}</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ ucwords($menu) }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('pengaturan.update', session('firebaseUserId')) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Username User</label>
                                <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                    placeholder="Username" name="username_user"
                                    value="{{ getDataUser(session('firebaseUserId'))['username_user'] }}" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Email User</label>
                                <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                    placeholder="Email" name="email_user"
                                    value="{{ getDataUser(session('firebaseUserId'))['email_user'] }}" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control form-control-user form-control-lg fs-6"
                                    placeholder="Password" name="password_user" id="password_user"
                                    onchange="validasiPass()">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Konfirmasi Password</label>
                                <input type="password" class="form-control form-control-user form-control-lg fs-6"
                                    placeholder="Konfirmasi Password" name="konfirmasi_password_user"
                                    id="konfirmasi_password_user" onchange="validasiPass()">
                            </div>
                        </div>
                        @if ((string) getDataUser(session('firebaseUserId'))['tipe_user'] === '2')
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Telepon Pegawai</label>
                                    <input type="number" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="No Telepon" name="telp_pegawai"
                                        value="{{ getDataPegawai(session('firebaseUserId'))['telp_pegawai'] }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Jenis Kelamin</label>
                                    <select class="form-control" name="jk_pegawai" required>
                                        <option value="" selected disabled>Jenis Kelamin</option>
                                        @foreach ($jenis_kelamin as $key => $value)
                                            <option value="{{ $value['key'] }}"
                                                {{ getDataPegawai(session('firebaseUserId'))['jk_pegawai'] === $value['key'] ? 'selected' : '' }}>
                                                {{ $value['value'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Foto Pegawai</label>
                                    <input type="file" class="form-control" id="input-foto-pengguna" name="foto_pegawai"
                                        placeholder="Foto" accept="image/png, image/jpeg, image/jpg">
                                </div>
                            </div>
                        @endif
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
