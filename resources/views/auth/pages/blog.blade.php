@extends('auth.layouts.dashboard')
@section('title_page', 'Blog')
@section('breadcrumb', 'Blog')

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

    <!-- Tabel Blog -->
    <div class="card">
        <div class="card-header">
            <h5>Data Blog</h5>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">Tambah Blog</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Konten</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $blog->judul_blog }}</td>
                            <td>{{ $blog->konten }}</td>
                            <td>
                                @if($blog->gambar_blog)
                                    <img src="{{ asset('images/' . $blog->gambar_blog) }}" alt="Gambar Blog" style="max-width: 100px;">
                                @else
                                    <span>Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $blog->id_blog }}">Edit</button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $blog->id_blog }}">Hapus</button>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $blog->id_blog }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Blog</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{ route('admin.blog.update', $blog->id_blog) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="judul_blog">Judul Blog</label>
                                                <input type="text" class="form-control" name="judul_blog" value="{{ $blog->judul_blog }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="konten">Konten</label>
                                                <textarea class="form-control" name="konten" required>{{ $blog->konten }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="gambar_blog">Gambar Blog</label>
                                                <input type="file" class="form-control" name="gambar_blog">
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

                        <!-- Modal Hapus -->
                        <div class="modal fade" id="deleteModal{{ $blog->id_blog }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Blog</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{ route('admin.blog.delete', $blog->id_blog) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus blog ini?
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
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Blog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul_blog">Judul Blog</label>
                        <input type="text" class="form-control" name="judul_blog" required>
                    </div>
                    <div class="form-group">
                        <label for="konten">Konten</label>
                        <textarea class="form-control" name="konten" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="gambar_blog">Gambar Blog</label>
                        <input type="file" class="form-control" name="gambar_blog">
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
