@extends('layouts.pengguna-back')
@section('main')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Pengumuman</h1>
        <p class="mb-4">List Pengumuman</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Pengumuman</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('pengumuman.create') }}">
                    <button type="button" class="btn btn-primary mb-4">Tambah Pengumuman</button>
                </a>
                <div class="table-responsive" id="canvasTabel-tabelPengguna">
                    <table class="table table-bordered DataTables" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>N0</th>
                                <th>Nama</th>
                                <th>Pengumuman</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ getDataPegawai($value['id_pegawai'])['nama_pegawai'] }}</td>
                                    <td>{{ $value['isi_pengumuman'] }}</td>
                                    <td>{{ $value['tgl_pengumuman'] }}</td>
                                    <td>{{ getStatusPengumuman($value['status_pengumuman']) }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('pengumuman.edit', $value['id_pengumuman']) }}"
                                            class="btn btn-info btn-circle">
                                            <i class="fas fa-edit"></i>
                                        </a>&emsp;
                                        <form action="{{ route('pengumuman.destroy', $value['id_pengumuman']) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-circle btn-hapus-data-kulkul">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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
