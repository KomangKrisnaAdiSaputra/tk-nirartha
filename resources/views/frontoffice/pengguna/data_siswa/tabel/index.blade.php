@include('frontoffice.includes.dataTables')
<table class="table table-bordered DataTables" id="dataTable" width="100%" cellspacing="0">
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
        @foreach ($data['siswa'] as $key => $value)
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
                    <a href="{{ route('orangTua.editDataSiswa', $value['id_siswa']) }}" class="btn btn-info btn-circle"
                        style="padding: 10px 15px !important;">
                        <i class="fas fa-edit"></i>
                    </a>&emsp;
                    <a href="{{ route('orangTua.detailDataSiswa', $value['id_siswa']) }}"
                        class="btn btn-primary btn-circle" style="padding: 10px 15px !important;">
                        <i class="fas fa-info"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
