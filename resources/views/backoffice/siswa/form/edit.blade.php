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
                <form action="{{ route('siswa.update', $data['id_siswa']) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select class="form-control" name="id_kelas" required>
                                    <option selected disabled>List Kelas</option>
                                    @foreach ($dataKelas as $key => $value)
                                        <option value="{{ $value['id_kelas'] }}"
                                            {{ $value['id_kelas'] === $data['id_kelas'] ? 'selected' : '' }}>
                                            {{ $value['nama_kelas'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Nama Siswa</label>
                                <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                    name="nama_siswa" placeholder="Nama Siswa" value="{{ $data['nama_siswa'] }}" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Tanggal Diterima</label>
                                <input type="date" class="form-control form-control-user form-control-lg fs-6"
                                    name="tgl_diterima_siswa" min="{{ carbon()->toDateString() }}"
                                    {{ $data['tgl_diterima_siswa'] === '' ? 'required' : 'readonly' }}>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Status Siswa</label>
                                <select class="form-control" name="status_siswa" required>
                                    <option selected disabled>Status</option>
                                    @foreach ($statusSiswa as $key => $value)
                                        <option value="{{ $value['key'] }}"
                                            {{ $value['key'] === $data['status_siswa'] ? 'selected' : '' }}>
                                            {{ $value['value'] }}</option>
                                    @endforeach
                                </select>
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
