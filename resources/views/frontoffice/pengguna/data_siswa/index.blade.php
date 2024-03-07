@extends('layouts.pengguna-front')
@section('data')
    <div class="container-fluid mt-4">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Siswa</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('orangTua.tambahDataSiswa') }}">
                    <button type="button" class="btn btn-primary mb-4">Tambah Siswa</button>
                </a>
                <div class="table-responsive" id="tabel-siswa">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>N0</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Kelas</th>
                                <th>Status</th>
                                <th>Tanggal Diterima</th>
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
                            {{-- @foreach ($data['siswa'] as $key => $value)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $value['nama_siswa'] }}</td>
                                    <td>{{ $value['jk_siswa'] != '' ? getJkPegawai($value['jk_siswa']) : 'Jenis Kelamin Kosong' }}
                                    </td>
                                    <td>
                                        {{ $value['id_kelas'] != '' ? getDataKelas($value['id_kelas'])['nama_kelas'] : 'Kelas Tidak Ditemukan!' }}
                                    </td>
                                    <td>{{ getStatusSiswa($value['status_siswa']) }}</td>
                                    <td>{{ $value['tgl_diterima_siswa'] === '' ? '-' : $value['tgl_diterima_siswa'] }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('orangTua.editDataSiswa', $value['id_siswa']) }}"
                                            class="btn btn-info btn-circle" style="padding: 10px 15px !important;">
                                            <i class="fas fa-edit"></i>
                                        </a>&emsp;
                                        <a href="{{ route('orangTua.detailDataSiswa', $value['id_siswa']) }}"
                                            class="btn btn-primary btn-circle" style="padding: 10px 15px !important;">
                                            <i class="fas fa-info"></i>
                                        </a>
                                        <form action="{{ route('pegawai.destroy', $value['id_pegawai']) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-circle btn-hapus-data-kulkul">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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
        $.get("{{ route('orangTua.tabelDataSiswa') }}", {})
            .done(function(data, status) {
                let tabel = $('#tabel-siswa');
                tabel.html("");
                tabel.html(data);
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.error("Error:", errorThrown);
            });
    </script>
@endsection
@endsection
