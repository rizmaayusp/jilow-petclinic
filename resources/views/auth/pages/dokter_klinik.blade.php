@extends('auth.layouts.dashboard')
@section('title_page', 'Dokter Klinik')
@section('breadcrumb', 'Dokter Klinik')

@section('content')
<div class="container">
    <h1>Manajemen Dokter Klinik</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2>Tambah Dokter Baru</h2>
    <form action="{{ route('admin.dokter-klinik.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="nama_dokter" class="form-label">Nama Dokter</label>
            <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" required>
        </div>
        <div class="mb-3">
            <label for="id_cabang_klinik" class="form-label">Cabang Klinik</label>
            <select class="form-select" id="id_cabang_klinik" name="id_cabang_klinik" required>
                <option value="">Pilih Cabang Klinik</option>
                @foreach($cabangs as $cabang)
                    <option value="{{ $cabang->id_cabang_klinik }}">{{ $cabang->nama_cabang }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Dokter</button>
    </form>

    <h2 class="mt-5">Daftar Dokter</h2>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Dokter</th>
                <th>Nama Dokter</th>
                <th>Cabang Klinik</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dokters as $dokter)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $dokter->id_dokter }}</td>
                    <td>{{ $dokter->nama_dokter }}</td>
                    <td>{{ $dokter->cabangKlinik->nama_cabang }}</td>
                    <td>
                        <form action="{{ route('admin.dokter-klinik.destroy', $dokter->id_dokter) }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokter ini?');">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editDokterModal{{ $dokter->id_dokter }}">Edit</button>

                        <!-- Modal Edit Dokter -->
                        <div class="modal fade" id="editDokterModal{{ $dokter->id_dokter }}" tabindex="-1" aria-labelledby="editDokterModalLabel{{ $dokter->id_dokter }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editDokterModalLabel{{ $dokter->id_dokter }}">Edit Dokter</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.dokter-klinik.update', $dokter->id_dokter) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="mb-3">
                                                <label for="nama_dokter{{ $dokter->id_dokter }}" class="form-label">Nama Dokter</label>
                                                <input type="text" class="form-control" id="nama_dokter{{ $dokter->id_dokter }}" name="nama_dokter" value="{{ $dokter->nama_dokter }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="id_cabang_klinik{{ $dokter->id_dokter }}" class="form-label">Cabang Klinik</label>
                                                <select class="form-select" id="id_cabang_klinik{{ $dokter->id_dokter }}" name="id_cabang_klinik" required>
                                                    @foreach($cabangs as $cabang)
                                                        <option value="{{ $cabang->id_cabang_klinik }}" {{ $dokter->id_cabang_klinik == $cabang->id_cabang_klinik ? 'selected' : '' }}>{{ $cabang->nama_cabang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Modal Edit Dokter -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
