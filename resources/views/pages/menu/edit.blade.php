@extends('components.main')
@section('title')
    - Edit Menu
@endsection
@section('container')
    <h1 class="app-page-title">Edit Menu</h1>
    <form class="settings-form" action=" {{ route('menu.update', $menu->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row g-3 settings-section">
            @error('foto')
                <p class="small text-danger">{{ $message }}</p>
            @enderror
            <div class="col-12 col-md-4 picture-container"
                style="display: flex; flex-direction: column; justify-content: center;">
                <img src="{{ asset('storage/' . $menu->foto) }}" alt="" class="img-fluid picture-preview">
                <input type="file" id="select-picture" name="foto">
                <div class="black-screen">{{ $menu->foto }} <p> click to change </p>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings p-4">
                    <div class="app-card-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                id="nama" value="{{ old('nama', $menu->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="harga_modal" class="form-label">Harga Modal</label>
                            <input type="text" class="form-control @error('harga_modal') is-invalid @enderror"
                                id="harga_modal" name="harga_modal"
                                value="{{ old('harga_modal', number_format($menu->harga_modal, 0, ',', '.')) }}" required>
                            @error('harga_modal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <input type="text" name="harga_jual" class="form-control" id="harga_jual"
                                value="{{ old('harga_jual', number_format($menu->harga_jual, 0, ',', '.')) }}" required>
                            @error('harga_jual')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="setting-input-4" class="form-label">Kategori</label>
                            <select class="form-select @error('id_kategori') is-invalid @enderror" id="setting-input-4"
                                name="id_kategori" required>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" @if (old('id_kategori', $menu->id_kategori) == $kategori->id) selected @endif>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input id="deskripsi" type="hidden" name="deskripsi"
                                value="{{ old('deskripsi', $menu->deskripsi) }}">
                            <trix-editor input="deskripsi"></trix-editor>
                            @error('deskripsi')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn app-btn-info">Save Changes</button>
                        <a href="/menu/" class="btn btn-danger text-white" role="button">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        const select_picture = document.getElementById('select-picture');
        const input_picture = document.getElementById('input-picture');
        const picture_preview = document.querySelector('.picture-preview');
        const black_screen = document.querySelector('.black-screen');

        select_picture.addEventListener('change', function() {
            const files = select_picture.files[0];
            const fileReader = new FileReader();
            fileReader.readAsDataURL(files);
            fileReader.addEventListener("load", function() {
                picture_preview.src = this.result;
                black_screen.innerHTML = `${files.name} <p> click to change </p>`
            });
        })
    </script>
    <script src="{{ asset('assets/js/formatmoney.js') }}"></script>
@endsection
