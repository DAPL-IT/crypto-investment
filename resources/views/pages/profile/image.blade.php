@extends('template.layouts.common-layout')
@section('page_title')
    Profile | Change Image
@endsection


@section('main_content')
    <div class="row px-1 mb-3">
        <div class="col-md-6 col-12 p-md-0">
            <div class="welcome-text px-md-4 px-1">
                <h6>Change Image</h6>
                <span style="font-size: 8pt;">Change your profile image</span>
            </div>
        </div>
        <div class="col-md-6 col-12 p-md-0 justify-content-md-end mt-0 d-flex">
            <ol class="breadcrumb pl-1 pb-0 mb-0" style="background: transparent;">
                <li class="breadcrumb-item"><a href="{{ route('user_profile.index') }}">Profile</a></li>
                <li class="breadcrumb-item "><a class="text-primary"
                        href="{{ route('user_profile.password.edit') }}">Image</a></li>
            </ol>
        </div>
    </div>
    <div class="row px-1">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="basic-form custom_file_input mb-4">
                        <form method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="form-group">
                                <label class="mb-2 pl-1"><small><b>Image</b></small></label>
                                <input type="file" class="form-control" name="image" accept=".jpg, .jpeg, .png">
                                <small class="form-text pt-1">Maximum image size allowed: 3Mb,<br>Recommended dimensions:
                                    200x200</small>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-xs btn-info" type="submit"><i
                                        class="fa-solid fa-floppy-disk"></i>&ensp;Save</button>
                                @if ($user->user_image)
                                    <a href={{ route('user_profile.image.delete') }}
                                        class="btn btn-xs btn-danger text-white"><i
                                            class="fa-solid fa-xmark"></i>&ensp;Remove</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
