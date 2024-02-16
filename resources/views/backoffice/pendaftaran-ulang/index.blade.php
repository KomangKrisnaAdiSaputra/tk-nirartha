@extends('layouts.pengguna-back')
@section('main')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{ ucwords($menu) }}</h1>
        <p class="mb-4">List {{ ucwords($menu) }}</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tabel {{ ucwords($menu) }}</h6>
                <a href="{{ route('getDataPendaftaranUlang') }}" target="_blank">
                    <button type="button" class="btn btn-danger">PDF</button>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="canvasTabel-tabelPengguna">
                    <table class="table table-bordered DataTables" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>N0</th>
                                <th>Id Pendaftaran</th>
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
                                    <td>{{ $value['id_pendaftaran_ulang'] }}</td>
                                    <td>{{ getDataSiswa($value['id_siswa'])['nama_siswa'] }}</td>
                                    <td><a href="{{ asset('image/pendaftaranUlang/' . $value['bukti_pembayaran_pendaftaran_ulang']) }}"
                                            target="_blank">{{ $value['bukti_pembayaran_pendaftaran_ulang'] }}</a></td>
                                    <td>{{ $value['catatan_pendaftaran_ulang'] }}</td>
                                    <td>{{ getStatusDaftarAwal($value['status_pendaftaran_ulang']) }}</td>
                                    <td>{{ $value['tgl_pendaftaran_ulang'] }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('pendaftaranUlang.edit', $value['id_siswa']) }}"
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
@section('js')
    <script>
        setInterval(function() {
            $.get("{{ route('cek_pegawai') }}", {}, function(data, status) {
                if (data) {
                    Swal.fire({
                        title: "Terdapat Data Baru Refresh Sekarang?",
                        showCancelButton: true,
                        confirmButtonText: "Refresh",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            });
        }, 10000);
    </script>
@endsection
@endsection
