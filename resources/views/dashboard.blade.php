@extends('template.layouts.common-layout')
@section('page_title')
Dashboard
@endsection
@section('extra_css')
<style>
    /* For Dashboard Cards */
    .feature-card {
        margin-bottom: 1.875rem;
        background: transparent !important;
        border: 0px solid transparent !important;
        box-shadow: none !important;
        height: calc(100% - 30px);
    }

    .font-8 {
        font-size: 8pt;
    }
</style>
@endsection

@section('main_content')
<div class="row px-1 mb-3">
    <div class="col-12 p-md-0">
        <div class="welcome-text px-md-5 px-sm-1">
            <h4>Hello {{ Auth::user()->username }}</h4>
            <span class="font-8">Welcome back to the platform</span>
        </div>
    </div>
</div>
<div class="row px-0 mb-2">
    <div class="col-12">
        <div class="card">
            <div class="card-body border-0 py-md-3 py-2 px-4">
                <h6 class="mb-1 text-primary">Total Earnings</h6>
                <span class="font-8">{{ $user->user_transaction_brief->total_earning??'0' }}</span>
            </div>
            <div class="card-footer pt-0 pb-0 text-center">
                <div class="row">
                    <div class="col-4 py-2 border-right px-1">
                        <h6 class="mb-1 text-primary">{{ $user->user_transaction_brief->total_withdraw??'0' }}</h6>
                        <span class="font-8">Withdraws</span>
                    </div>
                    <div class="col-4 py-2 border-right px-1">
                        <h6 class="mb-1 text-primary">{{ $user->user_transaction_brief->total_deposit??'0' }}</h6>
                        <span class="font-8">Deposits</span>
                    </div>
                    <div class="col-4 py-2">
                        <h6 class="mb-1 text-primary px-1">0</h6>
                        <span class="font-8">Tasks</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row px-1">
    <div class="col-md-3 col-sm-4 col-4  px-1">
        <div class="card card-coin feature-card">
            <div class="card-body text-center p-2 d-flex flex-column justify-content-center align-items-center">
                <h2 class="text-info mb-0 font-w700">
                    <i class="fa-solid fa-address-card" style="font-size: 25pt !important"></i>
                </h2>
                <p class="mb-0 font-w600 mt-2" style="font-size: 8pt !important">
                    Personal Info
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-4 col-4  px-1">
        <a href="{{ route('deposit.index') }}">
            <div class="card card-coin feature-card">
                <div class="card-body text-center p-2 d-flex flex-column justify-content-center align-items-center">
                    <h2 class="text-warning mb-0 font-w700">
                        <i class="fa-solid fa-sack-dollar" style="font-size: 25pt !important"></i>
                    </h2>
                    <p class="mb-0 mt-2 font-w600" style="font-size: 8pt !important">
                        Deposit
                    </p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3 col-sm-4 col-4  px-1">
        <div class="card card-coin feature-card">
            <div class="card-body text-center p-2 d-flex flex-column justify-content-center align-items-center">
                <h2 class="mb-0 font-w700" style="color: rgba(62, 110, 255, 1)">
                    <i class="fa-solid fa-credit-card" style="font-size: 25pt !important"></i>
                </h2>
                <p class="mb-0 font-w600 mt-2" style="font-size: 8pt !important">
                    Withdraw
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-4 col-4 px-1">
        <div class="card card-coin feature-card">
            <div class="card-body text-center p-2 d-flex flex-column justify-content-center align-items-center">
                <h2 class="mb-0 font-w700 text-primary">
                    <span class="material-icons" style="font-size: 25pt !important">
                        difference
                    </span>
                </h2>
                <p class="mb-0 font-w600 mt-0" style="font-size: 8pt !important">
                    Order History
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-4 col-4 px-1">
        <div class="card card-coin feature-card">
            <div class="card-body text-center p-2 d-flex flex-column justify-content-center align-items-center">
                <h2 class="mb-0 font-w700 text-info">
                    <i class="fa-solid fa-piggy-bank" style="font-size: 25pt !important"></i>
                </h2>
                <p class="mb-0 font-w600 mt-2" style="font-size: 8pt !important">
                    Account Details
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-4 col-4 px-1">
        <div class="card card-coin feature-card">
            <div class="card-body text-center p-2 d-flex flex-column justify-content-center align-items-center">
                <h2 class="mb-0 font-w700" style="color: salmon">
                    <i class="fa-solid fa-star" style="font-size: 25pt !important"></i>
                </h2>
                <p class="mb-0 font-w600 mt-2" style="font-size: 8pt !important">
                    VIP
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-4 col-4 px-1">
        <div class="card card-coin feature-card">
            <div class="card-body text-center p-2 d-flex flex-column justify-content-center align-items-center">
                <h2 class="mb-0 font-w700 text-warning">
                    <i class="fa-solid fa-money-bill-transfer" style="font-size: 25pt !important"></i>
                </h2>
                <p class="mb-0 font-w600 mt-2" style="font-size: 8pt !important">
                    Transaction
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-4 col-4 px-1">
        <div class="card card-coin feature-card">
            <div class="card-body text-center p-2 d-flex flex-column justify-content-center align-items-center">
                <h2 class="mb-0 font-w700 text-dark">
                    <i class="fa-solid fa-wallet" style="font-size: 25pt !important"></i>
                </h2>
                <p class="mb-0 font-w600 mt-2" style="font-size: 8pt !important">
                    Wallet
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-4 col-4 px-1">
        <div class="card card-coin feature-card">
            <div class="card-body text-center p-2 d-flex flex-column justify-content-center align-items-center">
                <h2 class="mb-0 font-w700" style="color: rgb(156, 61, 156)">
                    <i class="fa-solid fa-chart-column" style="font-size: 25pt !important"></i>
                </h2>
                <p class="mb-0 font-w600 mt-2" style="font-size: 8pt !important">
                    Team Report
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-4 col-4 px-1">
        <div class="card card-coin feature-card">
            <div class="card-body text-center p-2 d-flex flex-column justify-content-center align-items-center">
                <h2 class="mb-0 font-w700 text-success">
                    <i class="fa-solid fa-envelope" style="font-size: 25pt !important"></i>
                </h2>
                <p class="mb-0 font-w600 mt-2" style="font-size: 8pt !important">
                    Message
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-4 col-4 px-1">
        <div class="card card-coin feature-card">
            <div class="card-body text-center p-2 d-flex flex-column justify-content-center align-items-center">
                <h2 class="mb-0 font-w700" style="color: rgb(244, 106, 106)">
                    <i class="fa-solid fa-gift" style="font-size: 25pt !important"></i>
                </h2>
                <p class="mb-0 font-w600 mt-2" style="font-size: 8pt !important">
                    Gift
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-4 col-4 px-1">
        <div class="card card-coin feature-card">
            <div class="card-body text-center p-2 d-flex flex-column justify-content-center align-items-center">
                <h2 class="mb-0 font-w700 text-info">
                    <i class="fa-solid fa-download" style="font-size: 25pt !important"></i>
                </h2>
                <p class="mb-0 font-w600 mt-2" style="font-size: 8pt !important">
                    Download
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row px-1 mt-md-4 mt-3 mb-4">
    <div class="bootstrap-carousel col-12">
        <div class="carousel slide pointer-event" data-ride="carousel" data-interval="2000">
            <div class="carousel-inner border rounded">
                <div class="carousel-item active " style="height: 120px;">
                    <img class="d-block w-100  h-100 img-fluid"
                        src="https://t4.ftcdn.net/jpg/03/02/74/89/360_F_302748918_Vs76DTDodjhhkYuCEFahu0LcoDZkBuaW.jpg"
                        alt="First slide">
                </div>
                <div class="carousel-item  " style="height: 120px;">
                    <img class="d-block w-100 h-100 img-fluid"
                        src="https://st2.depositphotos.com/1265075/11464/i/450/depositphotos_114649452-stock-photo-demo-sign-on-red-cubes.jpg"
                        alt="Second slide">
                </div>
                <div class="carousel-item  " style="height: 120px;">
                    <img class="d-block w-100 h-100 img-fluid"
                        src="https://st2.depositphotos.com/1186248/5903/i/950/depositphotos_59038425-stock-photo-demo.jpg"
                        alt="Third slide">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row px-1 mt-md-4 mt-3 mb-4">
    <div class="col-12">
        <div class="card rounded">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-1 col-2 ">
                        <img src="{{ asset('images/assets/megaphone.png') }}" alt="" style="width: 35px">
                    </div>
                    <div class="col-md-11 col-10 ">
                        <marquee direction="left" scrollamount="5">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequatur, deleniti?
                        </marquee>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
