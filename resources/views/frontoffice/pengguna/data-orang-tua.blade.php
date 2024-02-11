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
                                    <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Nama Ayah..." name="nama_ayah"
                                        value="{{ $data['orang_tua']['nama_ayah'] }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Tempat Lahir Ayah..." name="tmp_lahir_ayah"
                                        value="{{ $data['orang_tua']['tmp_lahir_ayah'] }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="date" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Tanggal Lahir Ayah..." name="tgl_lahir_ayah"
                                        value="{{ $data['orang_tua']['tgl_lahir_ayah'] }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <select class="form-control" name="agama_ayah" required>
                                        <option selected disabled>Agama Ayah</option>
                                        <option value="Islam"
                                            {{ $data['orang_tua']['agama_ayah'] === 'Islam' ? 'selected' : '' }}>
                                            Islam</option>
                                        <option value="Kristen Protestan"
                                            {{ $data['orang_tua']['agama_ayah'] === 'Kristen Protestan' ? 'selected' : '' }}>
                                            Kristen
                                            Protestan</option>
                                        <option value="Kristen Katolik"
                                            {{ $data['orang_tua']['agama_ayah'] === 'Kristen Katolik' ? 'selected' : '' }}>
                                            Kristen
                                            Katolik</option>
                                        <option value="Hindu"
                                            {{ $data['orang_tua']['agama_ayah'] === 'Hindu' ? 'selected' : '' }}>
                                            Hindu</option>
                                        <option value="Buddha"
                                            {{ $data['orang_tua']['agama_ayah'] === 'Buddha' ? 'selected' : '' }}>Buddha
                                        </option>
                                        <option value="Konghucu"
                                            {{ $data['orang_tua']['agama_ayah'] === 'Konghucu' ? 'selected' : '' }}>Konghucu
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <select class="form-control" name="pendidikan_terakhir_ayah" required>
                                        <option selected disabled>Pendidikan Terakhir Ayah</option>
                                        <option value="TK"
                                            {{ $data['orang_tua']['pendidikan_terakhir_ayah'] === 'TK' ? 'selected' : '' }}>
                                            TK
                                        </option>
                                        <option value="SD"
                                            {{ $data['orang_tua']['pendidikan_terakhir_ayah'] === 'SD' ? 'selected' : '' }}>
                                            SD
                                        </option>
                                        <option value="SMP"
                                            {{ $data['orang_tua']['pendidikan_terakhir_ayah'] === 'SMP' ? 'selected' : '' }}>
                                            SMP
                                        </option>
                                        <option value="SMA"
                                            {{ $data['orang_tua']['pendidikan_terakhir_ayah'] === 'SMA' ? 'selected' : '' }}>
                                            SMA
                                        </option>
                                        <option value="Sarjana"
                                            {{ $data['orang_tua']['pendidikan_terakhir_ayah'] === 'Sarjana' ? 'selected' : '' }}>
                                            Sarjana</option>
                                        <option value="Magister"
                                            {{ $data['orang_tua']['pendidikan_terakhir_ayah'] === 'Magister' ? 'selected' : '' }}>
                                            Magister</option>
                                        <option value="Doktor"
                                            {{ $data['orang_tua']['pendidikan_terakhir_ayah'] === 'Doktor' ? 'selected' : '' }}>
                                            Doktor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Pekerjaan Ayah..." name="pekerjaan_ayah"
                                        value="{{ $data['orang_tua']['pekerjaan_ayah'] }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
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
                                    <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Nama Ibu..." name="nama_ibu"
                                        value="{{ $data['orang_tua']['nama_ibu'] }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Tempat Lahir Ibu..." name="tmp_lahir_ibu"
                                        value="{{ $data['orang_tua']['tmp_lahir_ibu'] }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="date" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Tanggal Lahir Ibu..." name="tgl_lahir_ibu"
                                        value="{{ $data['orang_tua']['tgl_lahir_ibu'] }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <select class="form-control" name="agama_ibu" required>
                                        <option selected disabled>Agama Ibu</option>
                                        <option value="Islam"
                                            {{ $data['orang_tua']['agama_ibu'] === 'Islam' ? 'selected' : '' }}>
                                            Islam</option>
                                        <option value="Kristen Protestan"
                                            {{ $data['orang_tua']['agama_ibu'] === 'Kristen Protestan' ? 'selected' : '' }}>
                                            Kristen
                                            Protestan</option>
                                        <option value="Kristen Katolik"
                                            {{ $data['orang_tua']['agama_ibu'] === 'Kristen Katolik' ? 'selected' : '' }}>
                                            Kristen
                                            Katolik</option>
                                        <option value="Hindu"
                                            {{ $data['orang_tua']['agama_ibu'] === 'Hindu' ? 'selected' : '' }}>
                                            Hindu</option>
                                        <option value="Buddha"
                                            {{ $data['orang_tua']['agama_ibu'] === 'Buddha' ? 'selected' : '' }}>Buddha
                                        </option>
                                        <option value="Konghucu"
                                            {{ $data['orang_tua']['agama_ibu'] === 'Konghucu' ? 'selected' : '' }}>Konghucu
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <select class="form-control" name="pendidikan_terakhir_ibu" required>
                                        <option selected disabled>Pendidikan Terakhir Ibu</option>
                                        <option value="TK"
                                            {{ $data['orang_tua']['pendidikan_terakhir_ibu'] === 'TK' ? 'selected' : '' }}>
                                            TK
                                        </option>
                                        <option value="SD"
                                            {{ $data['orang_tua']['pendidikan_terakhir_ibu'] === 'SD' ? 'selected' : '' }}>
                                            SD
                                        </option>
                                        <option value="SMP"
                                            {{ $data['orang_tua']['pendidikan_terakhir_ibu'] === 'SMP' ? 'selected' : '' }}>
                                            SMP
                                        </option>
                                        <option value="SMA"
                                            {{ $data['orang_tua']['pendidikan_terakhir_ibu'] === 'SMA' ? 'selected' : '' }}>
                                            SMA
                                        </option>
                                        <option value="Sarjana"
                                            {{ $data['orang_tua']['pendidikan_terakhir_ibu'] === 'Sarjana' ? 'selected' : '' }}>
                                            Sarjana</option>
                                        <option value="Magister"
                                            {{ $data['orang_tua']['pendidikan_terakhir_ibu'] === 'Magister' ? 'selected' : '' }}>
                                            Magister</option>
                                        <option value="Doktor"
                                            {{ $data['orang_tua']['pendidikan_terakhir_ibu'] === 'Doktor' ? 'selected' : '' }}>
                                            Doktor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user form-control-lg fs-6"
                                        placeholder="Pekerjaan Ibu..." name="pekerjaan_ibu"
                                        value="{{ $data['orang_tua']['pekerjaan_ibu'] }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
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
