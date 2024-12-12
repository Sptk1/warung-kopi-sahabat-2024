@extends('components.main')
@section('title')
    - Kelola Menu
@endsection
@section('container')
    <h1 class="app-page-title mb-2">Kelola Menu</h1>
    <div class="menu mb-4">
        <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
            @foreach ($kategoris as $kategori)
                <li class="nav-item">
                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#{{ $kategori->nama }}"
                        role="tab">
                        <h4>{{ $kategori->nama }}</h4>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
        @foreach ($kategoris as $kategori)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $kategori->nama }}" role="tabpanel">
                <div class="row g-4">
                    @foreach ($menus->where('kategori.nama', $kategori->nama) as $menu)
                        <div class="col-6 col-md-4 col-xl-3 col-xxl-2 mb-4 mb-lg-0">
                            <div class="card rounded shadow-sm h-100 app-card-doc border-0 card-menu">
                                <div class="card-body p-4">
                                    <img src="{{ asset('storage/' . $menu->foto) }}" alt=""
                                        class="img-fluid d-block mx-auto mb-3">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="col-11 text-banner text-primary text-capitalize">{{ $menu->nama }}</h5>
                                        <div class="app-card-actions">
                                            <div class="dropdown">
                                                <div class="dropdown-toggle no-toggle-arrow mx-3" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical" style="cursor: pointer;"></i>
                                                </div>
                                                <ul class="dropdown-menu">
                                                    <input type="hidden" value="{{ $menu->id }}" id="menu_id">
                                                    <li>
                                                        <a class="dropdown-item" id="show-menu" class="btn btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#show" role="button"><i
                                                                class="fa-solid fa-eye mx-2"></i> View</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('menu.edit', $menu->id) }}"><i
                                                                class="fa-solid fa-pen-to-square mx-2"></i> Edit</a></li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li class="delete">
                                                        <form action="{{ route('menu.destroy', $menu->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item border-0 bg-transparent"
                                                                onclick="return confirm('are you sure?')"><i
                                                                    class="fa-solid fa-trash-can mx-2"></i> Delete</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="small price">Rp.{{ number_format($menu->harga_jual, 0, ',', '.') }}<span
                                            class="nominal"></span></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="modal fade" style="margin-top: 9%; margin-left: 9%;" data-bs-backdrop="static" data-bs-keyboard="false"
            id="show" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Menu</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0" id="menu-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('assets/js/show.js') }}"></script>
@endsection
