@extends('template.layouts.common-layout')
@section('page_title')
    Banner Slider
@endsection


@section('main_content')
    <div class="row px-1 mb-3">
        <div class="col-12 p-md-0">
            <div class="welcome-text px-md-4 px-1">
                <h6>Manage Banners</h6>
                <span style="font-size: 8pt;">You can upload and delete banners</span>
            </div>
        </div>
    </div>
    <div class="row px-1">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="basic-form custom_file_input mb-4">
                        <form method="POST" action="{{ route('banner_slider.create') }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="input-group">
                                <input type="file" class="form-control input-rounded " name="banner"
                                    accept=".jpg, .jpeg, .png" id="bannerInputField" required autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn btn-info custom-input-group-btn" type="submit"><i
                                            class="fa-solid fa-upload"></i>&nbsp;Upload
                                    </button>
                                </div>
                            </div>
                            <small class="form-text pt-1">Maximum image size allowed: 5Mb,<br>Recommended dimensions:
                                900x450</small>
                        </form>
                    </div>
                    @if (count($allBanners) < 1)
                        <p class="text-info"><small>You haven't add any banners yet!</small></p>
                    @else
                        <ul class="list-group">
                            @foreach ($allBanners as $single)
                                <li class="list-group-item d-flex justify-content-between align-items-center px-2">
                                    <img class="img-fluid col-sm-11 col-xs-10" src="{{ asset($single->banner_full_path) }}"
                                        alt="{{ $single->file_name }}" style="max-height: 105px;">
                                    <form action="{{ route('banner_slider.delete', ['id' => $single->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-danger shadow btn-xs sharp delete col-sm-1 col-xs-2">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </li>
                            @endforeach

                        </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_script')
    <script>
        $('.delete').on('click', (e) => {
            e.preventDefault()
            const targetItem = e.currentTarget
            console.log(targetItem)
            Swal.fire({
                title: "Warning",
                text: "Are you sure you want to delete this?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                confirmButtonText: "DELETE"
            }).then((result) => {
                if (result.value) {
                    targetItem.closest('form').submit()
                }
            });
        })
    </script>
@endsection
