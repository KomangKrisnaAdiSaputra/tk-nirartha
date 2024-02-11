@extends('layouts.pengguna-back')
@section('main')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{ ucwords($menu) }}</h1>
        <p class="mb-4">List {{ ucwords($menu) }}</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel {{ ucwords($menu) }}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="canvasTabel-tabelPengguna">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>N0</th>
                                <th>Nama</th>
                                <th>Bukti Pembayaran</th>
                                <th>Catatan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ getDataSiswa($value['id_siswa'])['nama_siswa'] }}</td>
                                    <td><a href="{{ asset('image/pendaftaranAwal/' . $value['bukti_pembayaran_pendaftaran_awal']) }}"
                                            target="_blank">{{ $value['bukti_pembayaran_pendaftaran_awal'] }}</a></td>
                                    <td>{{ $value['catatan_pendaftaran_awal'] }}</td>
                                    <td>{{ getStatusDaftarAwal($value['status_pendaftaran_awal']) }}</td>
                                    <td>{{ $value['tgl_pendaftaran_awal'] }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('pendaftaranAwal.edit', $value['id_siswa']) }}"
                                            class="btn btn-info btn-circle">
                                            <i class="fas fa-edit"></i>
                                        </a>&emsp;
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
