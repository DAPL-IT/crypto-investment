@extends('template.layouts.common-layout')
@section('page_title')
    Profile | Edit Password
@endsection


@section('main_content')
    <div class="row px-1 mb-3">
        <div class="col-md-6 col-12 p-md-0">
            <div class="welcome-text px-md-4 px-1">
                <h6>Change Password</h6>
                <span style="font-size: 8pt;">Change your password</span>
            </div>
        </div>
        <div class="col-md-6 col-12 p-md-0 justify-content-md-end mt-0 d-flex">
            <ol class="breadcrumb pl-1 pb-0 mb-0" style="background: transparent;">
                <li class="breadcrumb-item"><a href="{{ route('user_profile.index') }}">Profile</a></li>
                <li class="breadcrumb-item "><a class="text-primary"
                        href="{{ route('user_profile.password.edit') }}">Password</a></li>
            </ol>
        </div>
    </div>
    <div class="row px-1">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="basic-form custom_file_input mb-4">
                        <form method="POST" action="{{ route('user_profile.password.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="mb-2 pl-1"><small><b>Current Password</b></small></label>
                                <input type="password" class="form-control" name="prevpwd" required>
                            </div>
                            <div class="form-group">
                                <label class="mb-2 pl-1"><small><b>New Password</b></small></label>
                                <input type="password" class="form-control" name="newpwd" required>
                            </div>
                            <div class="form-group">
                                <label class="mb-2 pl-1"><small><b>Confirm Password</b></small></label>
                                <input type="password" class="form-control" name="newpwd_confirmation" required>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-xs btn-info" type="submit"><i
                                        class="fa-solid fa-floppy-disk"></i>&ensp;Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
