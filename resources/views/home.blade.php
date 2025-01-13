@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div>
    <h1>Selamat Datang di <span style="color: var(--primary-color);">Aplikasi Rekam Medis</span></h1>
    <p class="lead">Kelola data pasien, rekam medis, dan lainnya dengan mudah.</p>
    <div class="icon-text">
        <i class="icon bi bi-heart-fill"></i>
        <span>Jaga kesehatan pasien dengan data yang akurat.</span>
    </div>
    <a href="{{ route('pasiens.index') }}" class="btn btn-secondary mt-3">Mulai Kelola Data</a>
</div>
@endsection
