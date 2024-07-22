@extends('auth.layouts.dashboard')
@section('title_page', 'Layanan Kami')
@section('breadcrumb', 'Layanan Kami')

@section('content')
<div class="container">
    <!-- Tampilkan pesan sukses -->
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <!-- Tampilkan pesan error -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Tabel Layanan -->
    <div class="card">
        <div class="card-header">
            <h5>Data Layanan</h5>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">Tambah Layanan</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>ID Layanan</th>
                        <th>Nama Layanan</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($layanans as $layanan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($layanan->gambar_layanan)
                                    <img src="{{ asset('images/' . $layanan->gambar_layanan) }}" alt="Gambar Layanan" style="max-width: 100px;">
                                @else
                                    <span>Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>{{ $layanan->id_layanan }}</td>
                            <td>{{ $layanan->nama_layanan }}</td>
                            <td>{{ $layanan->kategori->nama_kategori }}</td>
                            <td>{{ $layanan->deskripsi_layanan }}</td>
                            <td>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $layanan->id_layanan }}">Edit</button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $layanan->id_layanan }}">Hapus</button>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $layanan->id_layanan }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Layanan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{ route('admin.layanan.update', $layanan->id_layanan) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="nama_layanan">Nama Layanan</label>
                                                <input type="text" class="form-control" name="nama_layanan" value="{{ $layanan->nama_layanan }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="kategori_id">Kategori</label>
                                                <select class="form-control" name="kategori_id" required>
                                                    @foreach($categories as $kategori)
                                                        <option value="{{ $kategori->id_kategori }}" {{ $layanan->kategori_id == $kategori->id_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="deskripsi_layanan">Deskripsi</label>
                                                <textarea class="form-control" name="deskripsi_layanan" required>{{ $layanan->deskripsi_layanan }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="gambar_layanan">Gambar Layanan</label>
                                                <input type="file" class="form-control" name="gambar_layanan">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Delete -->
                        <div class="modal fade" id="deleteModal{{ $layanan->id_layanan }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Layanan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{ route('admin.layanan.delete', $layanan->id_layanan) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            <p>Apakah anda yakin ingin menghapus layanan ini?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Layanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('admin.layanan.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_layanan">Nama Layanan</label>
                            <input type="text" class="form-control" name="nama_layanan" required>
                        </div>
                        <div class="form-group">
                            <label for="kategori_id">Kategori</label>
                            <select class="form-control" name="kategori_id" required>
                                @foreach($categories as $kategori)
                                    <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_layanan">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi_layanan" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="gambar_layanan">Gambar Layanan</label>
                            <input type="file" class="form-control" name="gambar_layanan">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
