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
                <a href="{{ route('pegawai.create') }}">
                    <button type="button" class="btn btn-primary mb-4">Tambah {{ ucwords($menu) }}</button>
                </a>
                <div class="table-responsive" id="canvasTabel-tabelPengguna">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>N0</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin Pegawai</th>
                                <th>Telepon</th>
                                <th>Foto</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $value['nama_pegawai'] }}</td>
                                    <td>{{ getJkPegawai($value['jk_pegawai']) }}</td>
                                    <td>{{ $value['telp_pegawai'] }}</td>
                                    <td>
                                        <a href="{{ asset('image/fotoPegawai/' . $value['foto_pegawai']) }}"
                                            target="_blank">{{ $value['foto_pegawai'] }}</a>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('pegawai.edit', $value['id_pegawai']) }}"
                                            class="btn btn-info btn-circle">
                                            <i class="fas fa-edit"></i>
                                        </a>&emsp;
                                        <form action="{{ route('pegawai.destroy', $value['id_pegawai']) }}" method="post">
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
@endsection
