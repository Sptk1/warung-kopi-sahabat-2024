@extends('components.main')
@section('title')
    - Tambah Meja Baru
@endsection
@section('container')
    <h1 class="app-page-title mb-4">Tambah Meja Baru</h1>
    <div class="col-12 col-md-8">
        <div class="app-card-body">
            <form action="{{ route('meja.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="setting-input-1" class="form-label">Nama <span class="ms-2"></span></label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="setting-input-1"
                        name="nama" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn app-btn-primary w-100">Tambah</button>
            </form>
        </div>
    </div>
@endsection
