@extends('layouts.pengguna-front')
@section('data')
    <div class="container-fluid mt-4">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Pembayaran Siswa</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="canvasTabel-tabelPengguna">
                    <table class="table table-bordered DataTables" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>N0</th>
                                <th>Nama Siswa</th>
                                <th>Nama Pembayaran</th>
                                <th>Bukti Pembayaran</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['pembayaran'] as $key => $value)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ getDataSiswa($value['id_siswa'])['nama_siswa'] }}</td>
                                    <td>{{ $value['nama_biaya'] }}</td>
                                    <td>
                                        @if ($value['foto_pembayaran'] != '')
                                            <a href="{{ asset('image/fotoPembayaran/' . $value['foto_pembayaran']) }}"
                                                target="_blank">{{ $value['foto_pembayaran'] }}</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        {{ $value['tgl_pembayaran_biaya'] != '' ? $value['tgl_pembayaran_biaya'] : 'Belum Melakukan Pembayaran' }}
                                    </td>
                                    <td>{{ getStatusDaftarAwal($value['status_biaya']) }}</td>
                                    <td class="d-flex justify-content-center">
                                        @if ($value['status_biaya'] === '0')
                                            <a href="{{ route('orangTua.formPembayaranSiswa', $value['id_biaya']) }}"
                                                class="btn btn-info btn-circle" style="padding: 10px 15px !important;">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif
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
