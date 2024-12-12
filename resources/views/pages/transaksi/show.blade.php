@extends('components.order')

@section('container')
    <div class="row justify-content-center align-items-center">
        <div class="col-xl-12">
            <div class="row justify-content-around">
                <div class="col-md-5">
                    <div class="card border-0">
                        <div class="card-header card-2">
                            <p class="card-text text-muted mt-md-4 mb-2 space">Daftar Pesanan</p>
                            <hr class="my-2">
                        </div>
                        <div class="card-body pt-0">
                            <div style="max-height: 350px; overflow-y: auto; overflow-x: hidden;">
                                @foreach ($data as $transaksi)
                                    @foreach ($transaksi->detailTransaksis as $item)
                                        <div class="row justify-content-between mb-3 pe-2">
                                            <div class="col-auto col-md-7">
                                                <div class="media flex-column flex-sm-row">
                                                    <img class="img-fluid" src="{{ asset('storage/' . $item->menu->foto) }}"
                                                        width="62" height="62">
                                                    <div class="media-body my-auto">
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <p class="mb-0"><b>{{ $item->menu->nama }}</b></p>
                                                                <small
                                                                    class="text-muted">{{ $item->menu->kategori->nama ?? '' }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pl-0 flex-sm-col col-auto my-auto">
                                                <p class="boxed-1">{{ $item->jumlah }}</p>
                                            </div>
                                            <div class="pl-0 flex-sm-col col-auto my-auto">
                                                <p><b>Rp. {{ number_format($item->harga, 0, ',', '.') }}</b></p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                            <hr class="my-2">
                            @foreach ($data as $transaksi)
                                <div class="row">
                                    <div class="col">
                                        <div class="row justify-content-between mb-2">
                                            <div class="col-4">
                                                <p><b>Total</b></p>
                                            </div>
                                            <div class="flex-sm-col col-auto">
                                                <p class="mb-1"><b>Rp.
                                                        {{ number_format($transaksi->total_transaksi, 0, ',', '.') }}</b>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card border-0">
                        <div class="card-header pb-0">
                            <h2 class="card-title space">Pembayaran</h2>
                            <p class="card-text text-muted mt-4 space">Detail Pembayaran</p>
                            <hr class="my-0">
                        </div>
                        @foreach ($data as $transaksi)
                            @if ($transaksi->status)
                                <div class="card-body">
                                    <input type="hidden" name="id" id="id_transaksi" value="{{ $transaksi->id }}">
                                    <div class="form-group mb-3">
                                        <label for="name_cashier" class="small text-muted fw-semibold mb-1">Nama
                                            Kasir</label>
                                        <input type="text" class="form-control form-control-sm" disabled name="id_user"
                                            id="id_user" value="{{ $transaksi->user->nama }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="no_table" class="small text-muted fw-semibold mb-1">No. Meja</label>
                                        <input type="text" class="form-control form-control-sm" disabled name="id_meja"
                                            id="id_meja" value="{{ $transaksi->meja->nama }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="total_transaksi" class="small text-muted fw-semibold mb-1">Total
                                            Transaksi</label>
                                        <input type="text" class="form-control form-control-sm" disabled
                                            name="total_transaksi" id="total_transaksi"
                                            value="{{ number_format($transaksi->total_transaksi, 0, ',', '.') }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="total_pembayaran" class="small text-muted fw-semibold mb-1">Total
                                            Pembayaran</label>
                                        <input type="text" class="form-control form-control-sm" name="total_pembayaran"
                                            value="{{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}"
                                            id="harga_jual" disabled>
                                    </div>
                                    <div class="form-group mb-3 visually-hidden">
                                        <label for="kembalian" class="small text-muted fw-semibold mb-1">Total
                                            Kembalian</label>
                                        <input type="text"
                                            class="form-control form-control-sm kembalian @error('kembalian') is-invalid @enderror"
                                            id="kembalian" name="kembalian" value="" disabled>
                                    </div>
                                    <div class="row mb-md-5 mt-4">
                                        <div class="col">
                                            <a onclick="show_my_receipt1()"
                                                class="text-white btn btn-info w-100 btn-block">Lihat Nota</a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST"
                                    class="card-body">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="id" id="id_transaksi" value="{{ $transaksi->id }}">
                                    <div class="form-group mb-3">
                                        <label for="name_cashier" class="small text-muted fw-semibold mb-1">Nama
                                            Kasir</label>
                                        <input type="text" class="form-control form-control-sm" disabled
                                            name="name_cashier" id="name_cashier" value="{{ $transaksi->user->nama }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="no_table" class="small text-muted fw-semibold mb-1">No. Meja</label>
                                        <input type="text" class="form-control form-control-sm" disabled
                                            name="no_table" id="no_table" value="{{ $transaksi->meja->nama }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="total_transaksi" class="small text-muted fw-semibold mb-1">Total
                                            Transaksi</label>
                                        <input type="text" class="form-control form-control-sm" disabled
                                            name="total_transaksi" id="total_transaksi"
                                            value="{{ number_format($transaksi->total_transaksi, 0, ',', '.') }}">
                                        <input type="hidden" id="total" name="total_transaksi"
                                            value="{{ $transaksi->total_transaksi }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="total_pembayaran" class="small text-muted fw-semibold mb-1">Total
                                            Pembayaran</label>
                                        <input type="text"
                                            class="form-control form-control-sm total_pembayaran @error('total_pembayaran') is-invalid @enderror"
                                            id="harga_jual" name="total_pembayaran"
                                            value="{{ old('total_pembayaran', $transaksi->total_pembayaran ?? '') }}">
                                        @error('total_pembayaran')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="kembalian" class="small text-muted fw-semibold mb-1">Total
                                            Kembalian</label>
                                        <input type="text"
                                            class="form-control form-control-sm kembalian @error('kembalian') is-invalid @enderror"
                                            id="kembalian" name="kembalian" value="" disabled>
                                    </div>
                                    <div class="row mb-md-5 mt-4">
                                        <div class="col">
                                            <button type="submit" onclick="show_my_receipt2()"
                                                class="text-white btn btn-primary w-100 btn-block">Bayar
                                                {{ number_format($transaksi->total_transaksi, 0, ',', '.') }}</button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const total_pembayaranFormat = document.querySelector('.total_pembayaran');
        const hiddenTotalPembayaran = document.getElementById('harga_jual');
        const totalTransaksi = parseInt(document.getElementById('total').value);
        const kembalianInput = document.getElementById('kembalian');

        total_pembayaranFormat.addEventListener('focus', function() {
            this.value = ''; // Kosongkan input saat difokuskan
            hiddenTotalPembayaran.value = ''; // Kosongkan hidden input
            kembalianInput.value = '0'; // Reset kembalian
        });

        total_pembayaranFormat.addEventListener('input', function() {
            const unformattedValue = this.value.replace(/\./g, '');
            const totalPembayaran = parseInt(unformattedValue) || 0;

            // Format ulang angka yang dimasukkan
            this.value = new Intl.NumberFormat('id-ID').format(unformattedValue);

            // Perbarui nilai input hidden
            hiddenTotalPembayaran.value = unformattedValue;

            // Hitung kembalian
            const kembalian = totalPembayaran - totalTransaksi;
            kembalianInput.value = kembalian >= 0 ?
                new Intl.NumberFormat('id-ID').format(kembalian) :
                '0';
        });


        function show_my_receipt1() {
            const idTransaksi = document.getElementById('id_transaksi').value;
            const totalPembayaranInput = document.getElementById("harga_jual");

            if (!totalPembayaranInput.value) {
                alert("Total pembayaran tidak boleh kosong.");
                return false;
            } else {
                // Simpan total pembayaran ke localStorage
                localStorage.setItem('total_pembayaran', totalPembayaranInput.value);

                // Buka halaman nota
                const page = '/transaksi/nota/' + idTransaksi;
                const myWindow = window.open(page, "_blank");
                myWindow.focus();
            }
        }

        function show_my_receipt2() {
            const idTransaksi = document.getElementById('id_transaksi').value;
            const totalPembayaranInput = document.getElementById("harga_jual");
            const totalTransaksiInput = document.getElementById("total");
            const totalPembayaran = parseInt(totalPembayaranInput.value.replace(/\./g, ''));
            const totalTransaksi = parseInt(totalTransaksiInput.value);

            if (!totalPembayaranInput.value) {
                alert("Total pembayaran tidak boleh kosong.");
                return false;
            } else if (totalPembayaran < totalTransaksi) {
                alert("Total pembayaran tidak boleh kurang dari total transaksi!");
                return false;
            } else {
                // Hitung kembalian
                const kembalian = totalPembayaran - totalTransaksi;

                // Simpan total pembayaran dan kembalian ke localStorage
                localStorage.setItem('total_pembayaran', totalPembayaranInput.value);
                localStorage.setItem('kembalian', new Intl.NumberFormat('id-ID').format(kembalian));

                // Buka halaman nota
                const page = '/transaksi/nota/' + idTransaksi;
                const myWindow = window.open(page, "_blank");
                myWindow.focus();
            }
        }
    </script>


    <script src="{{ asset('assets/js/formatmoney.js') }}"></script>
@endsection
