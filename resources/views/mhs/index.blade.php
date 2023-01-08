@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h1>Data Mahasiswa</h1>
            </div>
        </div>
        <div class="col-lg-12 margin-tb mb-3">
            <div class="float-left">
                <a href="{{ route('mhsexport') }}" class="btn btn-primary">Export</a>
            </div>
            <div class="float-right">
                <a href="{{ route('create') }}" class="btn btn-primary">Add Data</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered mb-3" cellpadding=3>
        <thead>
            <tr>
                <th col width="50">ID</th>
                <th col width="155">Aksi</th>
                <th col width="120">Nama</th>
                <th col width="220">Jenis Kelamin</th>
                <th col width="220">Agama</th>
                <th col width="220">Tempat Lahir</th>
                <th col width="220">Tanggal Lahir</th>
                <th col width="220">Alamat</th>
                <th col width="220">Kota</th>
                <th col width="220">Kabupaten</th>
                <th col width="220">Provisi</th>
                <th col width="220">Telepon</th>
                <th col width="220">Wa</th>
                <th col width="220">Email</th>
                <th col width="220">Status Camaba</th>
                <th col width="220">Asal Sekolah</th>
                <th col width="220">Nilai Ijazah/Rapot</th>
                <th col width="220">Tahun Lulus</th>
                <th col width="220">Jenjang Yang Dipilih</th>
                <th col width="220">Pilih Prodi 1</th>
                <th col width="220">Pilih Prodi 2</th>
                <th col width="220">Pilih Prodi 3</th>
                 
                
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $value)
            <tr>
                <td>{{ $value['id'] }}</td>
                <td>
                    <form action="{{ route('destroy', $value['id']) }}" method="post">
                    @csrf
                    @method("delete")
                        {{-- <a href="{{ route('show', $value['id']) }}" class="btn btn-info">Show</a> --}}
                        <a href="{{ route('edit', $value['id']) }}" class="btn btn-success" 
                            role="button">Edit</a>
                        <a href="{{ route('destroy', $value['id']) }}" class="btn btn-danger" role="button" 
                            onclick="return confirm('Yakin akan menghapus {{ $value['nama'] }}')">Delete</a>
                    </form>                    
                </td>
                <td>{{ $value['nama'] }}</td>
                <td>{{ $value['jenis_kelamin'] }}</td>
                <td>{{ $value['agama'] }}</td>
                <td>{{ $value['tempat_lahir'] }}</td>
                <td>{{ $value['tanggal_lahir'] }}</td>
                <td>{{ $value['alamat'] }}</td>
                <td>{{ $value['kota'] }}</td>
                <td>{{ $value['kabupaten'] }}</td>
                <td>{{ $value['provinsi'] }}</td>
                <td>{{ $value['tlp'] }}</td>
                <td>{{ $value['wa'] }}</td>
                <td>{{ $value['email'] }}</td>
                <td>{{ $value['status_camaba'] }}</td>
                <td>{{ $value['asal_sekolah'] }}</td>
                <td>{{ $value['nilai'] }}</td>
                <td>{{ $value['thn_lulus'] }}</td>
                <td>{{ $value['jenjang_yang_dipilih'] }}</td>
                <td>{{ $value['pilih_prodi1'] }}</td>
                <td>{{ $value['pilih_prodi2'] }}</td>
                <td>{{ $value['pilih_prodi3'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection