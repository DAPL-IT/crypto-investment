@extends('template.layouts.common-layout')
@section('page_title')
    Profile | Edit General Information
@endsection


@section('main_content')
    <div class="row px-1 mb-3">
        <div class="col-md-6 col-12 p-md-0">
            <div class="welcome-text px-md-4 px-1">
                <h6>General Information</h6>
                <span style="font-size: 8pt;">Update your profile general information</span>
            </div>
        </div>
        <div class="col-md-6 col-12 p-md-0 justify-content-md-end mt-0 d-flex">
            <ol class="breadcrumb pl-1 pb-0 mb-0" style="background: transparent;">
                <li class="breadcrumb-item"><a href="{{ route('user_profile.index') }}">Profile</a></li>
                <li class="breadcrumb-item "><a class="text-primary"
                        href="{{ route('user_profile.general.edit') }}">General</a></li>
            </ol>
        </div>
    </div>
    <div class="row px-1">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="basic-form custom_file_input mb-4">
                        <form method="POST" action="{{ route('user_profile.general.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="mb-2 pl-1"><small><b>Telegram</b></small></label>
                                <input type="text" class="form-control" name="whatsapp" required
                                    value="{{ $user->whatsapp }}">
                            </div>
                            <div class="form-group">
                                <label class="mb-2 pl-1"><small><b>Email</b></small></label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                            </div>
                            <div class="form-group">

                                <label class="mb-2 pl-1"><small><b>Phone</b></small></label>
                                <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                                {{-- <small class="form-text pt-1">Keep it within 15 letters</small> --}}
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
