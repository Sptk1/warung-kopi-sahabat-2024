@extends('components.order')
@section('title')
    - Buat Pesanan Baru
@endsection
@section('container')
    <div class="col-md-8 p-0 h-100 flex flex-column justify-content-between">
        <div class="hd-menu d-flex align-items-center justify-content-between shadow bg-white">
            <div class="col-sm-5 d-flex align-items-center">
                <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img">
                        <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"
                            d="M4 7h22M4 15h22M4 23h22"></path>
                    </svg>
                </a>
                <h5 class="fs-5 fw-bold text-black ms-4">Semua Menu</h5>
            </div>
        </div>
        <div class="wp-menu d-flex flex-column">
            <div class="menu-tr mt-3 mb-3">
                <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    @foreach ($kategoris as $kategori)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                href="#{{ $kategori->nama }}" role="tab">
                                <h4>{{ $kategori->nama }}</h4>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="tab-content menu-tab overflow-auto" style="height: 85%" data-aos="fade-up" data-aos-delay="300">
                @foreach ($kategoris as $kategori)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $kategori->nama }}"
                        role="tabpanel">
                        <div class="menu-content pe-4 ps-4 d-flex flex-wrap justify-content-between">
                            @foreach ($menus->where('kategori.nama', $kategori->nama) as $menu)
                                <div class="menu-item-cart rounded shadow d-flex align-items-center justify-content-around"
                                    data-id="{{ $menu->id }}" style="margin-bottom: 7%;">
                                    <img class="img-fluid" src="{{ asset('storage/' . $menu->foto) }}" alt=""
                                        srcset="" width="150">
                                    <div class="d-flex justify-content-center flex-column">
                                        <div class="product">
                                            <h5 style="font-size: 16px; width: 100px;" class="text-break">
                                                {{ $menu->nama }}</h5>
                                            <h6 style="font-size: 13px;">{{ number_format($menu->harga_jual, 0, ',', '.') }}
                                            </h6>
                                        </div>
                                        <div class="qty d-flex mt-3">
                                            <button class="border-0 rounded bg-transparent RemovetoCart"><i
                                                    class="fa-solid fa-minus" style="font-size: 12px;"></i></button>
                                            <div class="qty-numbers me-3 ms-3">
                                                0
                                            </div>
                                            <button class="border-0 rounded bg-transparent AddtoCart"><i
                                                    class="fa-solid fa-plus" style="font-size: 12px;"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-4 h-100 p-0 d-flex flex-column">
        <div class="cart-title d-flex justify-content-between align-items-center p-4 shadow-sm">
            <h5 class="text-white">Pesanan</h5>
            <button class="fas fa-broom text-white" onclick="deleteOrder()" role="button"></button>
        </div>
        <div class="cart-body d-flex flex-column justify-content-between" style="height: 780px;">
            <div class="d-flex justify-content-between p-3 align-items-center">
                <h6 class="fw-semibold text-white ms-2 tables-selected">Meja: </h6>
                <h6 class="fw-semibold text-white me-2" style="font-size: 13px;">{{ now()->format('Y-m-d') }}</h6>
            </div>
            <div class="list-order align-self-center rounded p-4 mb-4">
                <div class="menu-order">

                </div>
            </div>
            <form action="{{ route('transaksi.store') }}" method="POST" class="align-self-center p-0 m-0" style="width: 90%;">
                @csrf
                <input type="hidden" name="id_menu" id="menu_id">
                <input type="hidden" name="id_meja" id="table_selected">
                <div class="cart-payment p-2 d-flex flex-column rounded">
                    <div class="subtotal d-flex justify-content-between align-items-center mt-3 p-2" style="height: 40px;">
                        <h6 class="text-white">Subtotal</h6>
                        <h6 class="sub-total text-white">Rp 0</h6>
                    </div>
                    <hr class="mt-3 text-white">
                    <div class="section-transaction d-flex justify-content-between align-items-center p-2">
                        <h6 class="text-white">Total</h6>
                        <h6 class="total-transaction text-white">Rp 0</h6>
                        <input type="hidden" name="total_transaksi">
                    </div>
                    <div class="section-pay d-flex justify-content-between align-items-center p-2">
                        <h6 class="text-white">Pilih Meja</h6>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#table">pilih</button>
                    </div>
                </div>
                <button type="submit"
                    class="w-100 cart-order p-3 mt-3 mb-3 rounded text-center border-0 text-dark bg-white">
                    Buat Pesanan
                </button>
            </form>
        </div>
    </div>
    <div class="modal fade" id="table" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content shadow" style="background-color: #181818fd">
                <div class="modal-header" id="staticBackdropLabel">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Pilih Meja</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="background-color: #fff"></button>
                </div>
                <div class="modal-body"
                    style="max-height: 500px; overflow-y: auto;">
                    <div class="row h-100">
                        <div class="col-12 p-0">
                            <div class="tables d-flex flex-column justify-content-between h-100">
                                <div class="top d-flex flex-wrap pb-5">
                                    @foreach ($mejas as $index => $meja)
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4 tab-container position-relative">
                                            <img class="table-B" src="{{ asset('assets/images/table/meja5.png') }}"
                                                width="100%" data-table="not-selected"
                                                data-number="{{ $meja->nama }}">
                                            <p
                                                class="position-absolute top-50 start-50 translate-middle fw-bold text-tables">
                                                {{ $meja->nama }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">Pilih</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/order.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/formatmoney.js') }}"></script> --}}
@endsection
