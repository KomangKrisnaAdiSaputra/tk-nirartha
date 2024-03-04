@include('backoffice.includes.dataTables')
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
                    <a href="{{ route('pengumuman.edit', $value['id_pengumuman']) }}" class="btn btn-info btn-circle">
                        <i class="fas fa-edit"></i>
                    </a>&emsp;
                    <form action="{{ route('pengumuman.destroy', $value['id_pengumuman']) }}" method="post">
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
