@extends('template.layouts.common-layout')
@section('page_title')
    Profile | Edit General Information
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
                        <form method="POST" action="">
                            @csrf
                            @method('PUT')


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
