@extends('layouts.pengguna-back')
@section('main')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Form</h1>
        <p class="mb-4">Form Edit {{ ucwords($menu) }}</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit {{ ucwords($menu) }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('pendaftaranAwal.update', $data['id_siswa']) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Id Pendaftaran</label>
                                <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                    value="{{ $data['id_pendaftaran_awal'] }}" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Nama Siswa</label>
                                <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                    name="nama_siswa" placeholder="Nama Siswa"
                                    value="{{ getDataSiswa($data['id_siswa'])['nama_siswa'] }}" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Tanggal Pendaftaran Awal</label>
                                <input type="date" class="form-control form-control-user form-control-lg fs-6"
                                    name="tgl_pendaftaran_awal" placeholder="Tanggal Pendaftaran Awal"
                                    value="{{ $data['tgl_pendaftaran_awal'] }}" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Catatan Pendaftaran Awal</label>
                                <textarea class="form-control" name="catatan_kelas" cols="20" rows="5" placeholder="Catatan Pendaftaran Awal"
                                    readonly>{{ $data['catatan_pendaftaran_awal'] }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Status Pendaftaran</label>
                                <select class="form-control" name="status_pendaftaran_awal" required>
                                    <option value="" selected disabled>Status</option>
                                    <option value="0" {{ $data['status_pendaftaran_awal'] === '0' ? 'selected' : '' }}>
                                        Proses</option>
                                    <option value="1" {{ $data['status_pendaftaran_awal'] === '1' ? 'selected' : '' }}>
                                        Selesai</option>
                                    <option value="2" {{ $data['status_pendaftaran_awal'] === '2' ? 'selected' : '' }}>
                                        In-Valid</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex pr-0 justify-content-end">
                        <a href="{{ route('pendaftaranAwal.index') }}"
                            class="btn bg-outline-secondary-modif mr-3">Kembali</a>
                        @if ($data['status_pendaftaran_awal'] === '0')
                            <button type="submit" class="btn bg-primary text-white">Simpan</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
