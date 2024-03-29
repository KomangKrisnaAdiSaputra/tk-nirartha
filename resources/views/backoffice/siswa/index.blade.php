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
                <div class="table-responsive" id="tabel-siswa">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>N0</th>
                                <th>No Induk</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Tanggal Diterima</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="spinner-border text-primary spinner-icon" role="status"></div>
                                        <p>Data Sedang Di Muat</p>
                                    </div>
                                </td>
                            </tr>
                            {{-- @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $value['no_induk'] }}</td>
                                    <td>{{ $value['nama_siswa'] }}</td>
                                    <td>{{ $value['id_kelas'] === '' ? 'Belum Memiliki Kelas' : getDataKelas($value['id_kelas'])['nama_kelas'] }}
                                    </td>
                                    <td>{{ $value['tgl_diterima_siswa'] === '' ? '-' : $value['tgl_diterima_siswa'] }}</td>
                                    <td>{{ getStatusSiswa($value['status_siswa']) }}</td>
                                    <td class="d-flex justify-content-center">
                                        @if (getDataPendaftaran($value['id_siswa']) === null)
                                            Belum Melakukan Pendaftaran Ulang
                                        @else
                                            @if (getDataPendaftaran($value['id_siswa'])['status_pendaftaran_ulang'] === '1')
                                                <a href="{{ route('siswa.edit', $value['id_siswa']) }}"
                                                    class="btn btn-info btn-circle">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @elseif(getDataPendaftaran($value['id_siswa'])['status_pendaftaran_ulang'] === '0')
                                                <a href="{{ route('pendaftaranUlang.edit', $value['id_siswa']) }}">
                                                    Belum Di Proses
                                                </a>
                                            @endif
                                        @endif
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
                $.get("{{ route('cek_siswa') }}", {})
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

            $.get("{{ route('siswa.create') }}", {})
                .done(function(data, status) {
                    let tabel = $('#tabel-siswa');
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
