@extends('layouts.pengguna-front')
@section('data')
    <div class="col-lg-6 col-md-12 mx-auto">

        <div class="account-setting">
            <h6>Data Orang Tua</h6>
            <form action="{{ route('orangTua.update', session('firebaseUserId')) }}" method="POST">
                @method('put')
                @csrf
                <input type="hidden" value="data_orang_tua" name="type">
                <!-- start form -->
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Nama Ayah</label>
                                    <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Nama Ayah..." name="nama_ayah"
                                        value="{{ $data['orang_tua']['nama_ayah'] }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Tempat Lahir Ayah</label>
                                    <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Tempat Lahir Ayah..." name="tmp_lahir_ayah"
                                        value="{{ $data['orang_tua']['tmp_lahir_ayah'] }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Tanggal Lahir Ayah</label>
                                    <input type="date" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Tanggal Lahir Ayah..." name="tgl_lahir_ayah"
                                        value="{{ $data['orang_tua']['tgl_lahir_ayah'] }}"
                                        max="{{ carbon()->toDateString() }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Agama Ayah</label>
                                    <select class="form-control" name="agama_ayah" required>
                                        <option selected disabled>Pilih Agama</option>
                                        @foreach (getDataAgama() as $key => $a)
                                            <option value="{{ $a }}"
                                                {{ $data['orang_tua']['agama_ayah'] === $a ? 'selected' : '' }}>
                                                {{ $a }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <label for="">Pendidikan Terakhir Ayah</label>
                                    <select class="form-control" name="pendidikan_terakhir_ayah" required>
                                        <option selected disabled>Pilih Pendidikan</option>
                                        @foreach (getDataPendidikan() as $key => $p)
                                            <option value="{{ $p }}"
                                                {{ $data['orang_tua']['pendidikan_terakhir_ayah'] === $p ? 'selected' : '' }}>
                                                {{ $p }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <label for="">Pekerjaan Ayah</label>
                                    <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Pekerjaan Ayah..." name="pekerjaan_ayah"
                                        value="{{ $data['orang_tua']['pekerjaan_ayah'] }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Telepon Ayah</label>
                                    <input type="number" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Telepon Ayah..." name="telp_ayah"
                                        value="{{ $data['orang_tua']['telp_ayah'] }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Nama Ibu</label>
                                    <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Nama Ibu..." name="nama_ibu"
                                        value="{{ $data['orang_tua']['nama_ibu'] }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Tempat Lahir Ibu</label>
                                    <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Tempat Lahir Ibu..." name="tmp_lahir_ibu"
                                        value="{{ $data['orang_tua']['tmp_lahir_ibu'] }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Tanggal Lahir Ibu</label>
                                    <input type="date" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Tanggal Lahir Ibu..." name="tgl_lahir_ibu"
                                        value="{{ $data['orang_tua']['tgl_lahir_ibu'] }}"
                                        max="{{ carbon()->toDateString() }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Agama Ibu</label>
                                    <select class="form-control" name="agama_ibu" required>
                                        <option selected disabled>Pilih Agama</option>
                                        @foreach (getDataAgama() as $key => $a)
                                            <option value="{{ $a }}"
                                                {{ $data['orang_tua']['agama_ibu'] === $a ? 'selected' : '' }}>
                                                {{ $a }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <label for="">Pendidikan Terakhir Ibu</label>
                                    <select class="form-control" name="pendidikan_terakhir_ibu" required>
                                        <option selected disabled>Pilih Pendidikan</option>
                                        @foreach (getDataPendidikan() as $key => $p)
                                            <option value="{{ $p }}"
                                                {{ $data['orang_tua']['pendidikan_terakhir_ibu'] === $p ? 'selected' : '' }}>
                                                {{ $p }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <label for="">Pekerjaan Ibu</label>
                                    <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Pekerjaan Ibu..." name="pekerjaan_ibu"
                                        value="{{ $data['orang_tua']['pekerjaan_ibu'] }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Telepon Ibu</label>
                                    <input type="number" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Telepon Ibu..." name="telp_ibu"
                                        value="{{ $data['orang_tua']['telp_ibu'] }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-end">
                    <button type="submit" class="btn bg-outline-secondary-modif" style="border: 2px solid #6c757d;">Edit
                        Data
                        Orang Tua</button>
                </div>
                <!-- end form -->
            </form>
        </div>
    </div>
@endsection
