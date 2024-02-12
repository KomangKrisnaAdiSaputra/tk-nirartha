@extends('layouts.pengguna-front')
@section('data')
    <div class="container-fluid mt-4">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Pendaftaran Awal</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('orangTua.formPendaftaranSiswa') }}">
                    <button type="button" class="btn btn-primary mb-4">Form Pendaftaran</button>
                </a>
                <div class="table-responsive" id="canvasTabel-tabelPengguna">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>N0</th>
                                <th>Nama</th>
                                <th>Bukti Pendaftaran</th>
                                <th>Catatan</th>
                                <th>Status</th>
                                <th>Tanggal Pendaftaran</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['pendaftaran_awal'] as $key => $value)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ getDataSiswa($value['id_siswa'])['nama_siswa'] }}</td>
                                    <td><a href="{{ asset('image/pendaftaranAwal/' . $value['bukti_pembayaran_pendaftaran_awal']) }}"
                                            target="_blank">{{ $value['bukti_pembayaran_pendaftaran_awal'] }}</a></td>
                                    <td>{{ $value['catatan_pendaftaran_awal'] }}</td>
                                    <td>{{ getStatusDaftarAwal($value['status_pendaftaran_awal']) }}</td>
                                    <td>{{ $value['tgl_pendaftaran_awal'] }}</td>
                                    <td class="d-flex justify-content-center">
                                        {{-- <a href="{{ route('orangTua.editDataSiswa', $value['id_siswa']) }}"
                                            class="btn btn-info btn-circle">
                                            <i class="fas fa-edit"></i>
                                        </a>&emsp;
                                        <a href="{{ route('orangTua.detailDataSiswa', $value['id_siswa']) }}"
                                            class="btn btn-primary btn-circle">
                                            <i class="fas fa-info"></i>
                                        </a> --}}
                                        {{-- <form action="{{ route('pegawai.destroy', $value['id_pegawai']) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-circle btn-hapus-data-kulkul">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form> --}}
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
