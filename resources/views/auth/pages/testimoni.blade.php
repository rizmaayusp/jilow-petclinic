@extends('auth.layouts.dashboard')
@section('title_page', 'Testimoni')
@section('breadcrumb', 'Testimoni')

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

    <!-- Tabel Testimoni -->
    <div class="card">
        <div class="card-header">
            <h5>Data Testimoni</h5>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">Tambah Testimoni</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Booking</th>
                        <th>Nama Pelanggan</th>
                        <th>ID Layanan</th>
                        <th>Nama Layanan</th>
                        <th>Konten</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($testimoni as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->id_booking }}</td>
                            <td>{{ $item->booking_kliniks->nama_user }}</td>
                            <td>{{ $item->id_layanan }}</td>
                            <td>{{ $item->layanans->nama_layanan }}</td>
                            <td>{{ $item->konten }}</td>
                            <td>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $item->id_testimoni }}">Edit</button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $item->id_testimoni }}">Hapus</button>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $item->id_testimoni }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Testimoni</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{ route('admin.testimoni.update', $item->id_testimoni) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="id_booking">ID Booking</label>
                                                <select class="form-control" name="id_booking" required>
                                                    @foreach($bookings as $booking)
                                                        <option value="{{ $booking->id_booking }}" {{ $item->id_booking == $booking->id_booking ? 'selected' : '' }}>{{ $booking->id_booking }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_layanan">ID Layanan</label>
                                                <select class="form-control" name="id_layanan" required>
                                                    @foreach($layanans as $layanan)
                                                        <option value="{{ $layanan->id_layanan }}" {{ $item->id_layanan == $layanan->id_layanan ? 'selected' : '' }}>{{ $layanan->id_layanan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="konten">Konten</label>
                                                <textarea class="form-control" name="konten" required>{{ $item->konten }}</textarea>
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
                        <div class="modal fade" id="deleteModal{{ $item->id_testimoni }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Testimoni</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{ route('admin.testimoni.destroy', $item->id_testimoni) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            <p>Apakah anda yakin ingin menghapus testimoni ini?</p>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Testimoni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('admin.testimoni.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id_booking">Nama Pelanggan</label>
                            <select class="form-control" name="id_booking" required>
                                <option value="">Pilih Nama Pelanggan</option>
                                @foreach($bookings as $booking)
                                    <option value="{{ $booking->id_booking }}">{{ $booking->nama_user }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_layanan">Layanan</label>
                            <select class="form-control" name="id_layanan" required>
                                <option value="">Pilih Layanan</option>
                                @foreach($layanans as $layanan)
                                    <option value="{{ $layanan->id_layanan }}">{{ $layanan->nama_layanan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="konten">Konten</label>
                            <textarea class="form-control" name="konten" required></textarea>
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
