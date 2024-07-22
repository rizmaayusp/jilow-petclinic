@extends('auth.layouts.dashboard')
@section('title_page', 'Email User Subscriber')
@section('breadcrumb', 'Email User Subscriber')

@section('content')
<div class="card">
    <div class="card-header">Email Newsletter</div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('admin.email-newsletter.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Email</button>
        </form>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($emails as $email)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $email->email }}</td>
                        <td>
                            <form action="{{ route('admin.email-newsletter.destroy', $email->id) }}" method="post">
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
@endsection
