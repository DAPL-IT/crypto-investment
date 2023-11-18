@extends('template.layouts.common-layout')
@section('page_title')
    Profile | Edit Details
@endsection


@section('main_content')
    <div class="row px-1 mb-3">
        <div class="col-md-6 col-12 p-md-0">
            <div class="welcome-text px-md-4 px-1">
                <h6>Profile Details</h6>
                <span style="font-size: 8pt;">Update your details</span>
            </div>
        </div>
        <div class="col-md-6 col-12 p-md-0 justify-content-md-end mt-0 d-flex">
            <ol class="breadcrumb pl-1 pb-0 mb-0" style="background: transparent;">
                <li class="breadcrumb-item"><a href="{{ route('user_profile.index') }}">Profile</a></li>
                <li class="breadcrumb-item "><a class="text-primary"
                        href="{{ route('user_profile.details.edit') }}">Details</a></li>
            </ol>
        </div>
    </div>
    <div class="row px-1">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="basic-form custom_file_input mb-4">
                        <form method="POST" action="">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="mb-2 pl-1"><small><b>Full Name</b></small></label>
                                    <input type="text" class="form-control" name="full_name" required
                                        value="{{ $userProfile->full_name }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="mb-2 pl-1"><small><b>Date Of Birth</b></small></label>
                                    <input type="date" class="form-control" name="date_of_birth"
                                        value="{{ $userProfile->date_of_birth }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="mb-2 pl-1"><small><b>Nationality</b></small></label>
                                    <input type="text" class="form-control" name="nationality"
                                        value="{{ $userProfile->nationality }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="mb-2 pl-1"><small><b>NID</b></small></label>
                                    <input type="text" class="form-control" name="nid"
                                        value="{{ $userProfile->nid }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="mb-2 pl-1"><small><b>Religion</b></small></label>
                                    <input type="text" class="form-control" name="religion"
                                        value="{{ $userProfile->religion }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="mb-2 pl-1"><small><b>Country</b></small></label>
                                    <input type="text" class="form-control" name="country"
                                        value="{{ $userProfile->country }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="mb-2 pl-1"><small><b>City</b></small></label>
                                    <input type="text" class="form-control" name="city"
                                        value="{{ $userProfile->city }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="mb-2 pl-1"><small><b>Post Code</b></small></label>
                                    <input type="text" class="form-control" name="post_code"
                                        value="{{ $userProfile->post_code }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="mb-2 pl-1"><small><b>Police Station</b></small></label>
                                    <input type="text" class="form-control" name="police_station"
                                        value="{{ $userProfile->police_station }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="mb-2 pl-1"><small><b>Present Address</b></small></label>
                                    <textarea class="form-control" name="present_address" rows="3">{{ $userProfile->present_address }}</textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="mb-2 pl-1"><small><b>Permanent Address</b></small></label>
                                    <textarea class="form-control" name="permanent_address" rows="3">{{ $userProfile->permanent_address }}</textarea>
                                </div>
                                <div class="form-group col-12">
                                    <button class="btn btn-xs btn-info" type="submit"><i
                                            class="fa-solid fa-floppy-disk"></i>&ensp;Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
