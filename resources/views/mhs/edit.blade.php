@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-2">
            <div class="float-left">
                <h1><strong>Edit Data Mahasiswa</strong></h1>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> terjadi kesalahan!
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('update', $data['id']) }}" class="form-group" method="POST">
        @csrf
        @method("put")
        <input type="text" class="form-control mb-3" name="nama" id="" placeholder="Nama">
        <input type="text" class="form-control mb-3" name="jenis_kelamin" id="" placeholder="Jenis Kelamin">
        <input type="text" class="form-control mb-3" name="agama" id="" placeholder="Agama">
        <input type="text" class="form-control mb-3" name="tempat_lahir" id="" placeholder="Tempat Lahir">
        <input type="text" class="form-control mb-3" name="tanggal_lahir" id="" placeholder="Tanggal Lahir">
        <input type="text" class="form-control mb-3" name="alamat" id="" placeholder="Alamat">
        <input type="text" class="form-control mb-3" name="kota" id="" placeholder="Kota">
        <input type="text" class="form-control mb-3" name="kabupaten" id="" placeholder="Kabupaten">
        <input type="text" class="form-control mb-3" name="provinsi" id="" placeholder="Provinsi">
        <input type="text" class="form-control mb-3" name="tlp" id="" placeholder="No. Telepon">
        <input type="text" class="form-control mb-3" name="wa" id="" placeholder="No. Whatsapp">
        <input type="text" class="form-control mb-3" name="email" id="" placeholder="Email">
        <input type="text" class="form-control mb-3" name="status_camaba" id="" placeholder="Status Calon Mahasiswa Baru">
        <input type="text" class="form-control mb-3" name="asal_sekolah" id="" placeholder="Asal Sekolah">
        <input type="text" class="form-control mb-3" name="alamat_sekolah" id="" placeholder="Alamat Sekolah">
        <input type="text" class="form-control mb-3" name="nilai" id="" placeholder="Nilai Ijazah / Raport">
        <input type="text" class="form-control mb-3" name="thn_lulus" id="" placeholder="Tahun Lulus">
        <input type="text" class="form-control mb-3" name="jenjang_yang_dipilih" id="" placeholder="Jenjang Yang Dipilih">
        <input type="text" class="form-control mb-3" name="pilih_prodi1" id="" placeholder="Prodi Pilihan 1">
        <input type="text" class="form-control mb-3" name="pilih_prodi2" id="" placeholder="Prodi Pilihan 2">
        <input type="text" class="form-control mb-3" name="pilih_prodi3" id="" placeholder="Prodi Pilihan 3">
        <button class="btn btn-primary" type="submit">Update</button>
    </form>
@endsection