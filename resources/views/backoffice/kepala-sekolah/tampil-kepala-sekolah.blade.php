@extends('layouts.pengguna-back')
@section('main')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Kepala Sekolah</h1>
        <p class="mb-4">Keterangan halaman</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Kepala Sekolah</h6>
            </div>
            <div class="card-body">
                <a href="{{ url('dashboard/kepala-sekolah/tambah') }}">
                    <button type="button" class="btn btn-primary mb-4">Tambah Kepala Sekolah</button>
                </a>
                <div class="table-responsive" id="canvasTabel-tabelPengguna">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Gender</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Gender</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>Susanto Widyanto</td>
                                <td>085158018388</td>
                                <td>Laki-laki</td>
                                <td>Denpasar barat, gatsu timur</td>
                                <td>susanto@gmail.com</td>
                                <td>
                                    <a href="edit-pengguna.html" class="btn btn-info btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" value=""
                                        class="btn btn-danger btn-circle btn-hapus-data-kulkul">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end page content -->
@endsection
