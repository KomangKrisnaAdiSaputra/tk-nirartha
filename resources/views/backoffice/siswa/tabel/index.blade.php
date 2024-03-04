@include('backoffice.includes.dataTables')
<table class="table table-bordered DataTables" id="dataTable" width="100%" cellspacing="0">
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
        @foreach ($data as $key => $value)
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
                            <a href="{{ route('siswa.edit', $value['id_siswa']) }}" class="btn btn-info btn-circle">
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
        @endforeach
    </tbody>
</table>
