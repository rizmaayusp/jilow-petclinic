@extends('auth.layouts.dashboard')

@section('title_page', 'Profile Admin')
@section('breadcrumb', 'Profile Admin')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Admin Profile</h1>
        <div class="card mb-4">
            <div class="card-header">Admin Profile</div>
            <div class="card-body">
                <div class="row">
                    {{-- <div class="col-md-4">
                        <img src="{{ asset('path_to_admin_image') }}" alt="Admin Image" class="img-fluid rounded-circle">
                    </div> --}}
                    <div class="col-md-8">
                        <h4>{{ auth()->user()->name }}</h4>
                        <p><strong>Email: </strong>{{ auth()->user()->email }}</p>
                        <p><strong>Level: </strong>{{ auth()->user()->level }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
