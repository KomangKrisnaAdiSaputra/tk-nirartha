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
                <form action="{{ route('pembayaran.update', $data['id_biaya']) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Nama Siswa</label>
                                <select class="form-control" name="id_siswa" required>
                                    <option value="{{ $data['id_siswa'] }}" selected>
                                        {{ getDataSiswa($data['id_siswa'])['nama_siswa'] }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Nama Biaya</label>
                                <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                    name="nama_biaya" placeholder="Nama Biaya" value="{{ $data['nama_biaya'] }}" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Bulan & Tahun</label>
                                <input type="month" class="form-control form-control-user form-control-lg fs-6"
                                    name="bulan&tahun" value="{{ $data['tahun_biaya'] . '-' . $data['bulan_biaya'] }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Tanggal Pembayaran</label>
                                <input type="date" class="form-control form-control-user form-control-lg fs-6"
                                    name="tgl_pembayaran_biaya" value="{{ $data['tgl_pembayaran_biaya'] }}" readonly>
                            </div>
                        </div>
                        <input type="hidden" value="{{ $data['foto_pembayaran'] }}" name="foto_pembayaran">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Status Pembayaran</label>
                                <select class="form-control" name="status_biaya" required>
                                    <option selected disabled>Status</option>
                                    @foreach ($status as $key => $s)
                                        @if ($data['tgl_pembayaran_biaya'] != '')
                                            <option value="{{ $s['key'] }}"
                                                {{ $s['key'] === $data['status_biaya'] ? 'selected' : '' }}>
                                                {{ $s['value'] }}
                                            </option>
                                        @else
                                            @if ($s['key'] === $data['status_biaya'])
                                                <option value="{{ $s['key'] }}"
                                                    {{ $s['key'] === $data['status_biaya'] ? 'selected' : '' }}>
                                                    {{ $s['value'] }}
                                                </option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex pr-0 justify-content-end">
                        <a href="{{ route('pembayaran.index') }}" class="btn bg-outline-secondary-modif mr-3">Kembali</a>
                        <button type="submit" class="btn bg-primary text-white">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
