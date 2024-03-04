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
                <a href="{{ route('kelas.create') }}">
                    <button type="button" class="btn btn-primary mb-4">Tambah {{ ucwords($menu) }}</button>
                </a>
                <div class="table-responsive" id="tabel-kelas">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>N0</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Catatan</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="spinner-border text-primary spinner-icon" role="status"></div>
                                        <p>Data Sedang Di Muat</p>
                                    </div>
                                </td>
                            </tr>
                            {{-- @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ getDataPegawai($value['id_pegawai'])['nama_pegawai'] ?? '-' }}</td>
                                    <td>{{ $value['nama_kelas'] }}</td>
                                    <td>{{ $value['catatan_kelas'] }}</td>
                                    <td>{{ getStatusPengumuman($value['status_kelas']) }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('kelas.edit', $value['id_kelas']) }}"
                                            class="btn btn-info btn-circle">
                                            <i class="fas fa-edit"></i>
                                        </a>&emsp;
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

        $.get("{{ route('kelas.show', 1) }}", {})
            .done(function(data, status) {
                let tabel = $('#tabel-kelas');
                tabel.html("");
                tabel.html(data);
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.error("Error:", errorThrown);
            });
    </script>
@endsection
@endsection
