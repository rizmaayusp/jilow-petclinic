@extends('auth.layouts.dashboard')
@section('title_page', 'Kategori')
@section('breadcrumb', 'Kategori')

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

    <!-- Tabel Kategori -->
    <div class="card">
        <div class="card-header">
            <h5>Data Kategori</h5>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">Tambah Kategori</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $kategori)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kategori->nama_kategori }}</td>
                            <td>{{ $kategori->deskripsi_kategori }}</td>
                            <td>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $kategori->id_kategori }}">Edit</button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $kategori->id_kategori }}">Hapus</button>
                            </td>
                        </tr>

<!-- Modal Edit-->
@foreach($categories as $kategori)
<div class="modal fade" id="editModal{{ $kategori->id_kategori }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="{{ route('admin.kategori.update', $kategori->id_kategori) }}">
        @csrf
        <div class="form-group">
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" class="form-control" name="nama_kategori" value="{{ $kategori->nama_kategori }}" required>
        </div>
        <div class="form-group">
            <label for="deskripsi_kategori">Deskripsi Kategori</label>
            <textarea class="form-control" name="deskripsi_kategori" required>{{ $kategori->deskripsi_kategori }}</textarea>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit"  class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endforeach

<!-- Modal Edit -->
{{-- @foreach ($categories as $kategori)
<div class="modal fade" id="editModal{{ $kategori->id_kategori }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.kategori.update', $kategori->id_kategori) }}">
                @csrf
                @method('PUT') <!-- Perubahan disini -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" class="form-control" name="nama_kategori" value="{{ $kategori->nama_kategori }}" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_kategori">Deskripsi Kategori</label>
                        <textarea class="form-control" name="deskripsi_kategori" required>{{ $kategori->deskripsi_kategori }}</textarea>
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
@endforeach --}}


                    <!-- Modal Hapus -->
                    <div class="modal fade" id="deleteModal{{ $kategori->id_kategori }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Kategori</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ route('admin.kategori.delete', $kategori->id_kategori) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                        <p>Yakin ingin menghapus kategori ini?</p>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.kategori.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" class="form-control" name="nama_kategori" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_kategori">Deskripsi Kategori</label>
                        <textarea class="form-control" name="deskripsi_kategori" required></textarea>
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
@endsection
