@extends('layouts.pengguna-back')
@section('main')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Form</h1>
        <p class="mb-4">Form Edit Pengumuman</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Pengumuman</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('pengumuman.update', $data['id_pengumuman']) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Isi Pengumuman</label>
                                <textarea class="form-control" id="isi_pengumuman" name="isi_pengumuman" cols="20" rows="5"
                                    placeholder="Isi Pengumuman">{{ $data['isi_pengumuman'] }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Tanggal Pengumuman</label>
                                <input type="date" class="form-control form-control-user form-control-lg fs-6"
                                    placeholder="" name="tgl_pengumuman" value="{{ $data['tgl_pengumuman'] }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Status Pengumuman</label>
                                <select class="form-control" name="status_pengumuman" required>
                                    <option value="" selected disabled>Status</option>
                                    @foreach ($status as $key => $value)
                                        <option value="{{ $value['key'] }}"
                                            {{ $data['status_pengumuman'] === '1' ? 'selected' : '' }}>
                                            {{ $value['value'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col d-flex pr-0 justify-content-end">
                        <a href="{{ route('pengumuman.index') }}" class="btn bg-outline-secondary-modif mr-3">Kembali</a>
                        <button type="submit" class="btn bg-primary text-white">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
