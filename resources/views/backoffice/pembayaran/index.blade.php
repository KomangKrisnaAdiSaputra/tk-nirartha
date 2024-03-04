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
                <a href="{{ route('pembayaran.create') }}">
                    <button type="button" class="btn btn-primary mb-4">Tambah {{ ucwords($menu) }}</button>
                </a>
                <div class="table-responsive" id="tabel-pembayaran">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>N0</th>
                                <th>Nama Siswa</th>
                                <th>Nama Biaya</th>
                                <th>Bulan Biaya</th>
                                <th>Tahun Biaya</th>
                                <th>Tanggal Pembayaran Biaya</th>
                                <th>Bukti Pembayaran</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="9">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="spinner-border text-primary spinner-icon" role="status"></div>
                                        <p>Data Sedang Di Muat</p>
                                    </div>
                                </td>
                            </tr>
                            {{-- @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ getDataSiswa($value['id_siswa'])['nama_siswa'] }}</td>
                                    <td>{{ $value['nama_biaya'] }}</td>
                                    <td>{{ carbon(true, $value['bulan_biaya'], 'm', 'F') }}</td>
                                    <td>{{ $value['tahun_biaya'] }}</td>
                                    <td>
                                        {{ $value['tgl_pembayaran_biaya'] != '' ? $value['tgl_pembayaran_biaya'] : 'Belum Melakukan Pembayaran' }}
                                    </td>
                                    <td>
                                        @if ($value['foto_pembayaran'] != '')
                                            <a href="{{ asset('image/fotoPembayaran/' . $value['foto_pembayaran']) }}"
                                                target="_blank">{{ $value['foto_pembayaran'] }}</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ getStatusDaftarAwal($value['status_biaya']) }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('pembayaran.edit', $value['id_biaya']) }}"
                                            class="btn btn-info btn-circle">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@section('js')
    <script>
        $(document).ready(function() {
            setInterval(function() {
                $.get("{{ route('cek_pembayaran') }}", {})
                    .done(function(data, status) {
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
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.error("Error:", errorThrown);
                    });
            }, 10000);

            $.get("{{ route('pembayaran.show', 1) }}", {})
                .done(function(data, status) {
                    let tabel = $('#tabel-pembayaran');
                    tabel.html("");
                    tabel.html(data);
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    console.error("Error:", errorThrown);
                });
        });
    </script>
@endsection
@endsection
