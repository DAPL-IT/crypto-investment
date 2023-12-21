@extends('template.layouts.common-layout')
@section('page_title')
    Company Info
@endsection

@section('main_content')
    <div class="row px-1 mb-3">
        <div class="col-12 p-md-0">
            <div class="welcome-text px-md-4 px-1">
                <h6>Company Profile</h6>
                <span style="font-size: 8pt;">Your company information</span>
            </div>
        </div>
    </div>
    <div class="row px-1">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p>
                        <a href="{{url('/')}}"><h1>flipcoin111.com</h1></a>
                        The branch of the company is located in Moscow. 29/9/2021 AD Project is being developed. It is
                        life-changing for the customer to become successful and self-sufficient.<br>
                        <a href="{{url('/')}}"><h4>flipcoin111.com.ltd</h4></a> is an established company for fast investment site worldwide Financially sound and negative companies.<br>
                        DEPOSIT WITHDRAWAL CUSTOMER SUPPORT 100% ALWAYS ACTIVE.<br>
                        WITHDRAWAL AS FAST As possible for <a href="{{url('/flipcoin111.com')}}">flipcoin111.com</a> customers feel good and welcome
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
