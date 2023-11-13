@extends('template.layouts.common-layout')
@section('page_title')
    Profile
@endsection


@section('main_content')
    <div class="row px-1 mb-3">
        <div class="col-12 p-md-0">
            <div class="welcome-text px-md-4 px-1">
                <h4>Manage Profile</h4>
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
                            @if (Auth::user()->user_image)
                                <img style="width: 80px" src="{{ asset(Auth::user()->user_image->icon_full_path) }}"
                                    class="img-fluid rounded" alt="{{ Auth::user()->username }}" />
                            @else
                                <img style="width: 80px"
                                    src="https://ui-avatars.com/api/?name={{ Auth::user()->username }}&background=f3f3f3&color=444444"
                                    class="img-fluid rounded" alt="{{ Auth::user()->username }}" />
                            @endif
                        </div>
                        <div class="profile-details">
                            <div class="profile-name px-3 pt-2">
                                <h4 class="text-primary mb-0">Mitchell C. Shay</h4>
                                <p>UX / UI Designer</p>
                            </div>
                            <div class="profile-email px-2 pt-2">
                                <h4 class="text-muted mb-0">info@example.com</h4>
                                <p>Email</p>
                            </div>
                            <div class="dropdown ml-auto">
                                <a href="#" class="btn btn-xs btn-danger light sharp" data-toggle="dropdown"
                                    aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
                                        viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                            <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                            <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                        </g>
                                    </svg></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item"><i class="fa fa-user-circle text-primary mr-2"></i> View
                                        profile</li>
                                    <li class="dropdown-item"><i class="fa fa-users text-primary mr-2"></i> Add to close
                                        friends</li>
                                    <li class="dropdown-item"><i class="fa fa-plus text-primary mr-2"></i> Add to group</li>
                                    <li class="dropdown-item"><i class="fa fa-ban text-primary mr-2"></i> Block</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
