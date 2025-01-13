@extends('layouts.auth-app')

@section('content')
<div id="main-wrapper" class="d-flex justify-content-center align-items-center min-vh-100" style="background-color: #f0f8ff;">
<!-- <div class="d-flex justify-content-center align-items-center vh-100"> -->
<div class="card shadow-lg rounded-5" style="max-width: 400px; width: 90%; height: 470px;">
    <div class="card-body">
        <div class="text-center mb-4">
            <img src="{{ asset('foto/logorekamedis.jpeg') }}" alt="Foto" width="100" height="100">
            <h3 class="fw-bold">Rekam Medis</h3>
            <h7 class="text-muted">Rumah Sakit Dustira</h7>
        </div>
        <form id="loginForm" method="POST" action="{{ route('login') }}" class="px-3">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control form-control-sm rounded-3" id="username" name="username" required placeholder="Masukkan Username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control form-control-sm rounded-3" id="password" name="password" required placeholder="Masukkan Password">
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-info btn-lg">Masuk</button>
            </div>
            <p class="text-muted text-center mt-3">Belum memiliki akun? Hubungi Admin.</p>
        </form>
    </div>
</div>

</div>

</div>
@endsection
