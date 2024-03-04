@include('backoffice.includes.dataTables')
<table class="table table-bordered DataTables" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>N0</th>
            <th>Nama Siswa</th>
            <th>Nama Biaya</th>
            <th>Bulan Biaya</th>
            <th>Tahun Biaya</th>
            <th>Tanggal Pembayaran Biaya</th>
            <th>Bukti Pembayaran</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $value)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ getDataSiswa($value['id_siswa'])['nama_siswa'] }}</td>
                <td>{{ $value['nama_biaya'] }}</td>
                <td>{{ carbon(true, $value['bulan_biaya'], 'm', 'F') }}</td>
                <td>{{ $value['tahun_biaya'] }}</td>
                <td>
                    {{ $value['tgl_pembayaran_biaya'] != '' ? $value['tgl_pembayaran_biaya'] : 'Belum Melakukan Pembayaran' }}
                </td>
                <td>
                    @if ($value['foto_pembayaran'] != '')
                        <a href="{{ asset('image/fotoPembayaran/' . $value['foto_pembayaran']) }}"
                            target="_blank">{{ $value['foto_pembayaran'] }}</a>
                    @else
                        -
                    @endif
                </td>
                <td>{{ getStatusDaftarAwal($value['status_biaya']) }}</td>
                <td class="d-flex justify-content-center">
                    <a href="{{ route('pembayaran.edit', $value['id_biaya']) }}" class="btn btn-info btn-circle">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
