@extends('auth.layouts.dashboard')
@section('title_page', 'Cabang Klinik')
@section('breadcrumb', 'Cabang Klinik')

@section('content')
<div class="container">
    <h1>Cabang Klinik</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.cabang-klinik.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="nama_cabang">Nama Cabang</label>
            <input type="text" class="form-control" id="nama_cabang" name="nama_cabang" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
        <div class="form-group">
            <label for="telepon">Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Cabang</button>
    </form>

    <h2>Daftar Cabang Klinik</h2>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Cabang</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>ID Dokter & Nama Dokter</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cabangs as $cabang)
                <tr>
                    <td>{{ $cabang->nama_cabang }}</td>
                    <td>{{ $cabang->alamat }}</td>
                    <td>{{ $cabang->telepon }}</td>
                    <td>
                        <ul>
                            @foreach($cabang->dokterKlinik as $dokter)
                                <li>{{ $dokter->id_dokter }} - {{ $dokter->nama_dokter  }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <form action="{{ route('admin.cabang-klinik.destroy', $cabang->id_cabang_klinik) }}" method="post" style="display:inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection
