@extends('template.layouts.common-layout')
@section('page_title')
    Profile
@endsection


@section('main_content')
    <div class="row px-1 mb-3">
        <div class="col-12 p-md-0">
            <div class="welcome-text px-md-4 px-1">
                <h6>Manage Profile</h6>
                <span style="font-size: 8pt;">Manage your profile information</span>
            </div>
        </div>
    </div>
    <div class="row px-1">
        <div class="col-12">
            <div class="profile card card-body px-3 pt-3 pb-0">
                <div class="profile-head">
                    <div class="profile-info">
                        <div>
                            @if ($user->user_image)
                                <img style="width: 80px" src="{{ asset($user->user_image->icon_full_path) }}"
                                    class="img-fluid rounded" alt="{{ $user->username }}" />
                            @else
                                <img style="width: 80px"
                                    src="https://ui-avatars.com/api/?name={{ $user->username }}&background=f3f3f3&color=444444"
                                    class="img-fluid rounded" alt="{{ $user->username }}" />
                            @endif
                        </div>
                        <div class="profile-details">
                            <div class="profile-name px-3 pt-2">
                                <h4 class="text-primary mb-0">{{ $user->username }}</h4>
                                <p class="text-lowercase">{{ $user->account_type }}</p>
                            </div>

                            <div class="dropdown ml-auto">
                                <a href="#" class="btn btn-xs btn-danger light sharp" data-toggle="dropdown"
                                    aria-expanded="true"><i class="fa-solid fa-ellipsis"></i></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item">Edit General</li>
                                    @if ($user->user_profile)
                                        <li class="dropdown-item">Edit Details</li>
                                    @endif
                                    <li class="dropdown-item">Change Password</li>
                                    <li class="dropdown-item">Profile Image</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#about-me" data-toggle="tab"
                                        class="nav-link show active"><small>General</small></a>
                                </li>
                                <li class="nav-item"><a href="#profile-settings" data-toggle="tab"
                                        class="nav-link"><small>Details</small></a>
                                </li>
                            </ul>
                            <div class="tab-content">

                                <div id="about-me" class="tab-pane fade active show">
                                    <div class="pt-3 profile-personal-info">
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <p class="f-w-500"><small>Name</small> <small class="pull-right">:</small>
                                                </p>
                                            </div>
                                            <div class="col-sm-9 col-7"><small>Mitchell C.Shay</small>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div id="profile-settings" class="tab-pane fade">
                                    <div class="pt-3 profile-personal-info">
                                        @if ($user->user_profile)
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <p class="f-w-500"><small>Name</small> <small
                                                            class="pull-right">:</small>
                                                    </p>
                                                </div>
                                                <div class="col-sm-9 col-7"><small>Mitchell C.Shay</small>
                                                </div>
                                            </div>
                                        @else
                                            <div class="text-center">
                                                <button class="btn btn-xs btn-primary">Add</button>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
