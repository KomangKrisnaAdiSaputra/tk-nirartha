@include('backoffice.includes.dataTables')
<table class="table table-bordered DataTables" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>N0</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Catatan</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $value)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ getDataPegawai($value['id_pegawai'])['nama_pegawai'] ?? '-' }}</td>
                <td>{{ $value['nama_kelas'] }}</td>
                <td>{{ $value['catatan_kelas'] }}</td>
                <td>{{ getStatusPengumuman($value['status_kelas']) }}</td>
                <td class="d-flex justify-content-center">
                    <a href="{{ route('kelas.edit', $value['id_kelas']) }}" class="btn btn-info btn-circle">
                        <i class="fas fa-edit"></i>
                    </a>&emsp;
                    {{-- <form action="{{ route('kelas.destroy', $value['id_kelas']) }}" method="post">
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
