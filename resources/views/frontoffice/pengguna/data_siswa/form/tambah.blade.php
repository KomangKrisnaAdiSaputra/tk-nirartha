@extends('layouts.pengguna-front')
@section('data')
    <div class="col-lg-6 col-md-12 mx-auto">
        <div class="account-setting">
            <h6>Data Siswa</h6>
            <form action="{{ route('orangTua.update', session('firebaseUserId')) }}" method="POST"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <input type="hidden" value="data_siswa" name="type">
                <input type="hidden" value="tambah" name="data_apa">
                <input type="hidden" value="0" name="status_siswa">
                <div class="row">
                    <div class="col-12 mb-3 text-center px-0">
                        @if (isset($data['siswa']['foto_siswa']))
                            <img src="{{ asset('image/fotoSiswa/' . $data['siswa']['foto_siswa']) }}"
                                class="img-fluid rounded mx-auto" style="width: 20%;" id="canvas-foto-siswa"
                                alt="foto siswa">
                        @else
                            <div class="form-group">
                                <label for="">Foto Siswa</label>
                                <input type="file" class="form-control form-control-user form-control-lg" id="foto_siswa"
                                    name="foto_siswa" placeholder="Foto Siswa" accept="image/png, image/jpeg, image/jpg"
                                    required>
                            </div>
                        @endif
                    </div>
                </div>
                @if (count($data['siswa']) > 0)
                    <div class="col-12 mb-4 mt-4 d-flex justify-content-between">
                        <span>Status Siswa : {{ $data['siswa']['status_siswa'] }}</span>
                        <span>Tanggal Diterima : {{ $data['siswa']['tgl_diterima_siswa'] }}</span>
                    </div>
                    <div class="col-12 mb-4 mt-4 d-flex justify-content-center">
                        <span>Kelas Siswa : {{ getDataKelas($data['siswa']['id_kelas']) }}</span>
                    </div>
                @endif
                <div class="col-12">
                    <div class="form-group">
                        <label for="">No Induk Siswa</label>
                        <input type="text" class="form-control form-control-user form-control-lg" name="no_induk"
                            placeholder="No Induk"
                            value="{{ isset($data['siswa']['no_induk']) ? $data['siswa']['no_induk'] : '' }}" required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Tahun Angkatan Siswa</label>
                        <input type="number" class="form-control form-control-user form-control-lg" name="tahun_angkatan"
                            placeholder="Tahun Angkatan" min="1900" max="2099"
                            value="{{ isset($data['siswa']['tahun_angkatan']) ? $data['siswa']['tahun_angkatan'] : '' }}"
                            required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Nama Siswa</label>
                        <input type="text" class="form-control form-control-user form-control-lg" name="nama_siswa"
                            placeholder="Nama Siswa"
                            value="{{ isset($data['siswa']['nama_siswa']) ? $data['siswa']['nama_siswa'] : '' }}" required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Agama Siswa</label>
                        <select class="form-control" name="agama_siswa" required>
                            <option value="" selected disabled>Pilih Agama</option>
                            @foreach (getDataAgama() as $key => $a)
                                <option value="{{ $a }}"
                                    {{ (isset($data['siswa']['agama_siswa']) ? $data['siswa']['agama_siswa'] : '' === $a) ? 'selected' : '' }}>
                                    {{ $a }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12" style="margin-top: 13%;">
                    <div class="form-group">
                        <label for="">Jenis Kelamin Siswa</label>
                        <select class="form-control" name="jk_siswa" required>
                            <option value="" selected disabled>Jenis Kelamin</option>
                            <option value="1"
                                {{ (isset($data['siswa']['jk_siswa']) ? (string) $data['siswa']['jk_siswa'] : '') === '1' ? 'selected' : '' }}>
                                Wanita
                            </option>
                            <option value="2"
                                {{ (isset($data['siswa']['jk_siswa']) ? (string) $data['siswa']['jk_siswa'] : '') === '2' ? 'selected' : '' }}>
                                Laki-laki
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-12" style="margin-top: 13%;">
                    <div class="form-group">
                        <label for="">Tanggal Lahir Siswa</label>
                        <input type="date" class="form-control form-control-user form-control-lg" name="tgl_lahir_siswa"
                            placeholder="Tanggal Lahir Siswa"
                            value="{{ isset($data['siswa']['tgl_lahir_siswa']) ? $data['siswa']['tgl_lahir_siswa'] : '' }}"
                            max="{{ carbon()->toDateString() }}" required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Tempat Lahir Siswa</label>
                        <input type="text" class="form-control form-control-user form-control-lg" name="tmp_lahir_siswa"
                            placeholder="Tempat Lahir Siswa"
                            value="{{ isset($data['siswa']['tmp_lahir_siswa']) ? $data['siswa']['tmp_lahir_siswa'] : '' }}"
                            required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Status Anak Siswa</label>
                        <input type="text" class="form-control form-control-user form-control-lg"
                            name="status_anak_siswa" placeholder="Status Anak Siswa"
                            value="{{ isset($data['siswa']['status_anak_siswa']) ? $data['siswa']['status_anak_siswa'] : '' }}"
                            required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Jumlah Saudara Siswa</label>
                        <input type="number" class="form-control form-control-user form-control-lg"
                            name="jumlah_saudara_siswa" min="1" placeholder="Jumlah Saudara Siswa"
                            value="{{ isset($data['siswa']['jumlah_saudara_siswa']) ? $data['siswa']['jumlah_saudara_siswa'] : '' }}"
                            required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Bahasa Siswa</label>
                        <input type="text" class="form-control form-control-user form-control-lg" name="bahasa_siswa"
                            placeholder="Bahasa Siswa"
                            value="{{ isset($data['siswa']['bahasa_siswa']) ? $data['siswa']['bahasa_siswa'] : '' }}"
                            required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Golongan Darah</label>
                        <select class="form-control" name="golongan_darah" required>
                            <option value="" selected disabled>Pilih golongan Darah</option>
                            @foreach (golDarah() as $key => $gd)
                                <option value="{{ $gd }}"
                                    {{ (isset($data['siswa']['golongan_darah']) ? $data['siswa']['golongan_darah'] : '' === $gd) ? 'selected' : '' }}>
                                    {{ $gd }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12" style="margin-top: 13%;">
                    <div class="form-group">
                        <label for="">Warga Negara Siswa</label>
                        <input type="text" class="form-control form-control-user form-control-lg"
                            name="warga_negara_siswa" placeholder="Warga Negara Siswa"
                            value="{{ isset($data['siswa']['warga_negara_siswa']) ? $data['siswa']['warga_negara_siswa'] : '' }}"
                            required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Kelurahan Siswa</label>
                        <input type="text" class="form-control form-control-user form-control-lg"
                            name="kelurahan_siswa" placeholder="Kelurahan Siswa"
                            value="{{ isset($data['siswa']['kelurahan_siswa']) ? $data['siswa']['kelurahan_siswa'] : '' }}"
                            required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Kabupaten Siswa</label>
                        <input type="text" class="form-control form-control-user form-control-lg"
                            name="kabupaten_siswa" placeholder="Kabupaten Siswa"
                            value="{{ isset($data['siswa']['kabupaten_siswa']) ? $data['siswa']['kabupaten_siswa'] : '' }}"
                            required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Provinsi Siswa</label>
                        <input type="text" class="form-control form-control-user form-control-lg"
                            name="provinsi_siswa" placeholder="Provinsi Siswa"
                            value="{{ isset($data['siswa']['provinsi_siswa']) ? $data['siswa']['provinsi_siswa'] : '' }}"
                            required>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    @if (isset($data['siswa']['kartu_kia_siswa']))
                        <img src="{{ asset('image/fotoKartuSiaSiswa/' . $data['siswa']['kartu_kia_siswa']) }}"
                            class="img-fluid rounded mx-auto" id="canvas-foto-siswa" alt="foto siswa"
                            style="width: 20%;">
                    @else
                        <div class="form-group">
                            <label for="">Kartu Kia Siswa</label>
                            <input type="file" class="form-control form-control-user form-control-lg"
                                id="kartu_kia_siswa" name="kartu_kia_siswa" placeholder="Kartu Kia Siswa"
                                accept="image/png, image/jpeg, image/jpg" required>
                        </div>
                    @endif
                </div>
                <div class="d-flex">
                    <div class="col d-flex justify-content-end">
                        <a href="{{ route('orangTua.dataSiswa') }}" type="button" class="btn bg-outline-danger-modif"
                            style="border: 2px solid red;">
                            Back</a>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <button type="submit" class="btn bg-outline-secondary-modif"
                            style="border: 2px solid #6c757d;">Tambah
                            Data
                            Siswa</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
