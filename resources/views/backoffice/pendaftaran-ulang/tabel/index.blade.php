@include('backoffice.includes.dataTables')
<table class="table table-bordered DataTables" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>N0</th>
            <th>Id Pendaftaran</th>
            <th>Nama</th>
            <th>Bukti Pembayaran</th>
            <th>Catatan</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $value)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $value['id_pendaftaran_ulang'] }}</td>
                <td>{{ getDataSiswa($value['id_siswa'])['nama_siswa'] }}</td>
                <td><a href="{{ asset('image/pendaftaranUlang/' . $value['bukti_pembayaran_pendaftaran_ulang']) }}"
                        target="_blank">{{ $value['bukti_pembayaran_pendaftaran_ulang'] }}</a></td>
                <td>{{ $value['catatan_pendaftaran_ulang'] }}</td>
                <td>{{ getStatusDaftarAwal($value['status_pendaftaran_ulang']) }}</td>
                <td>{{ $value['tgl_pendaftaran_ulang'] }}</td>
                <td class="d-flex justify-content-center">
                    <a href="{{ route('pendaftaranUlang.edit', $value['id_siswa']) }}" class="btn btn-info btn-circle">
                        <i class="fas fa-edit"></i>
                    </a>&emsp;
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
