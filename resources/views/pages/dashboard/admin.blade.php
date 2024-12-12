<div class="col-lg-8 mb-4 shadow rounded d-flex align-items-center bg-transparent">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-sm-7 ps-3">
                <div class="card-body">
                    <h5 class="card-title text-primary">Wellcome Back {{ auth()->user()->nama }}! 🎉</h5>
                    <p class="mb-4 text-dark">
                        Semangatlah
                    </p>
                </div>
            </div>
            <div id="carouselExampleFade" class="col-sm-5 text-center text-sm-left carousel slide carousel-fade"
                data-bs-ride="carousel">
                <div class="carousel-inner" style="padding-left: 25%;">
                    <div class="carousel-item active">
                        <img src="{{ asset('assets/images/foodicon/food-icon1.png') }}" class="d-block" height="180"
                            alt="food_icon">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/images/foodicon/food-icon2.png') }}" class="d-block" height="180"
                            alt="food_icon">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/images/foodicon/food-icon3.png') }}" class="d-block" height="180"
                            alt="food_icon">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-4 col-md-4 order-1">
    <div class="row ps-2 d-flex justify-content-evenly">
        <div class="col-lg-5 col-md-12 col-6 mb-4 shadow rounded">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="{{ asset('assets/images/icons/unicons/admin.png') }}" width="40"
                                alt="chart success" class="rounded" />
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1 text-dark">Admin</span>
                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                        {{ $admin }} karyawan</small>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-12 col-6 mb-4 shadow rounded">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="{{ asset('assets/images/icons/unicons/cashier.png') }}" width="40"
                                alt="Credit Card" class="rounded" />
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1 text-dark">Kasir</span>
                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                        {{ $kasir }} karyawan</small>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-12 col-6 mb-4 shadow rounded">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="{{ asset('assets/images/icons/unicons/wallet-info.png') }}" width="40"
                                alt="Credit Card" class="rounded" />
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1 text-dark">Total karyawan</span>
                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                        {{ $total_user }} karyawan</small>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-12 col-6 mb-4 shadow rounded">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="{{ asset('assets/images/icons/unicons/dollar-sign.png') }}" width="40"
                                alt="Credit Card" class="rounded" />
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1 text-dark">Total transaksi hari ini</span>
                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                        {{ $total_transaksi }} transaksi</small>
                </div>
            </div>
        </div>
    </div>
</div>
