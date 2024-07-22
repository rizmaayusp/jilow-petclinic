@extends('auth.layouts.dashboard')
@section('title_page', 'Manajemen Slot Waktu')
@section('breadcrumb', 'Manajemen Slot Waktu')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Tambah Slot Waktu
                </div>
                <div class="card-body">
                    <form action="{{ route('time-slots.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="slot">Slot Waktu</label>
                            <input type="text" name="slot" id="slot" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="card">
                <div class="card-header">
                    Daftar Slot Waktu
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Slot Waktu</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($slots as $slot)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $slot->slot }}</td>
                                <td>
                                    <form action="{{ route('time-slots.destroy', $slot->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
