@include('backoffice.includes.dataTables')
<table class="table table-bordered DataTables" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>N0</th>
            <th>Nama</th>
            <th>Email</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $value)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $value->username_user }}</td>
                <td>{{ $value->email_user }}</td>
                <td class="d-flex justify-content-center">
                    <a href="{{ route('dataOrangTua.show', $value->id_user) }}" class="btn btn-info btn-circle">
                        <i class="fas fa-info"></i>
                    </a>&emsp;
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
