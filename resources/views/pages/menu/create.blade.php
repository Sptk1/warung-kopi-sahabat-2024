@extends('components.main')
@section('title')
    - Tambah Menu Baru
@endsection
@section('container')
    <h1 class="app-page-title mb-4">Tambah Menu Baru</h1>
    <div class="col-lg-8">
        <form action="{{ route('menu.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                    required>
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="harga_modal" class="form-label">Harga Modal</label>
                <input type="text" class="form-control @error('harga_modal') is-invalid @enderror" id="harga_modal"
                    name="harga_modal" required>
                @error('harga_modal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="harga_jual" class="form-label">Harga Jual</label>
                <input type="text" class="form-control @error('harga_jual') is-invalid @enderror" id="harga_jual"
                    name="harga_jual" required>
                @error('harga_jual')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="id_kategori" class="form-label">Kategori</label>
                <select class="form-select @error('id_kategori') is-invalid @enderror" id="id_kategori" name="id_kategori"
                    required>
                    <option selected disabled>- pilih kategori -</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                @error('id_kategori')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <input id="deskripsi" type="hidden" name="deskripsi">
                <trix-editor input="deskripsi"></trix-editor>
                @error('deskripsi')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="img">Foto</label>
                @error('foto')
                    <p class="small text-danger">{{ $message }}</p>
                @enderror
                <div class="img-area">
                    <img class="img-preview">
                    <input type="file" id="img" class="select-image" name="foto">
                    <div class="view-path-img" data-path="false">
                        <h3>Foto</h3>
                        <p>Ukuran foto profil harus lebih kecil dari <span>2MB</span></p>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <button class="btn-submit btn btn-primary" type="submit">Tambah</button>
            </div>
        </form>
    </div>
    <script>
        const img = document.getElementById('img');
        const img_preview = document.querySelector('.img-preview');
        const view_path_img = document.querySelector('.view-path-img');
        const select_image = document.querySelector('.select-image');

        img.addEventListener('change', function() {
            const files = img.files[0];
            const fileReader = new FileReader();
            fileReader.readAsDataURL(files);
            fileReader.addEventListener("load", function() {
                img_preview.src = this.result;
                img_preview.style.opacity = '1';
                view_path_img.innerHTML = ` <h3>${files.name}</h3> <p>click to change</p>`;
                view_path_img.setAttribute('data-path', 'true');
            });
        })
    </script>
    <script src="{{ asset('assets/js/formatmoney.js') }}"></script>
@endsection
