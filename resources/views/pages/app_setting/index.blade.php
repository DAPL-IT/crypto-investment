@extends('template.layouts.common-layout')
@section('page_title')
    App Settings
@endsection


@section('main_content')
    <div class="row px-1 mb-3">
        <div class="col-12 p-md-0">
            <div class="welcome-text px-md-4 px-1">
                <h6>Manage App</h6>
            </div>
        </div>
    </div>
    <div class="row px-1">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="basic-form custom_file_input mb-4">
                        <form method="POST" action="{{ route('app_settings.update', ['id' => $appSetting->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="mb-2 pl-1"><small><b>Name</b></small></label>
                                <input type="text" class="form-control" name="app_name" required
                                    value="{{ $appSetting->app_name }}" placeholder="Type app name...">
                                <small class="form-text pt-1">Keep it within 15 letters</small>
                            </div>
                            <div class="form-group">
                                <label class="mb-2 pl-1"><small><b>Icon</b></small></label>
                                <input type="file" class="form-control" name="icon" accept=".jpg, .jpeg, .png">
                                <small class="form-text pt-1">Maximum image size allowed: 128Kb,<br>Recommended dimensions:
                                    64x64</small>
                            </div>
                            <div class="form-group">
                                <label class="mb-2 pl-1"><small><b>Background Image</b></small></label>
                                <input type="file" class="form-control" name="background" accept=".jpg, .jpeg, .png">
                                <small class="form-text pt-1">Maximum image size allowed: 5Mb,<br>Recommended dimensions:
                                    1920x1080
                                </small>
                            </div>
                            <div class="form-group">
                                <label class="mb-2 pl-1"><small><b>VIP Promo Image</b></small></label>
                                <input type="file" class="form-control" name="vip_promo" accept=".jpg, .jpeg, .png">
                                <small class="form-text pt-1">Maximum image size allowed: 3Mb,<br>Recommended dimensions:
                                    600x600
                                </small>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-xs btn-info" type="submit"><i
                                        class="fa-solid fa-floppy-disk"></i>&ensp;Save</button>
                                <a href={{ route('app_settings.optimize') }} class="btn btn-xs btn-success text-white"><i
                                        class="fa-solid fa-rotate"></i>&ensp;Optimize App</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
