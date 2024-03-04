@include('backoffice.includes.dataTables')
<table class="table table-bordered DataTables" id="dataTable" width="100%" cellspacing="0">
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
                    <a href="{{ route('pegawai.edit', $value['id_pegawai']) }}" class="btn btn-info btn-circle">
                        <i class="fas fa-edit"></i>
                    </a>&emsp;
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
