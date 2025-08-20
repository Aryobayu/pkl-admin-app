@extends('layouts.app')

@section('title', 'Formulir')

@section('content')
<div class="form-container">
    <h2>Formulir Pendaftaran</h2>

    <!-- Pesan sukses -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Pesan error -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('formulir.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan') }}" required>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" rows="4" required>{{ old('alamat') }}</textarea>
        </div>

        <button type="submit" class="btn-submit">Kirim</button>
    </form>
</div>

<!-- Style -->
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', sans-serif;
    }

    .form-container {
        background: white;
        max-width: 650px;
        margin: 40px auto;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.05);
    }

    .form-container h2 {
        text-align: center;
        color: #333;
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 6px;
        color: #444;
        font-weight: 500;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.15);
        outline: none;
    }

    .btn-submit {
        width: 100%;
        padding: 14px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn-submit:hover {
        background-color: #0056b3;
    }

    .alert {
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #e6ffed;
        color: #2c662d;
        border: 1px solid #b6e2c9;
    }

    .alert-danger {
        background-color: #ffe6e6;
        color: #a94442;
        border: 1px solid #f5c6cb;
    }
</style>
@endsection
