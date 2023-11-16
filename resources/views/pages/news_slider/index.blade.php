@extends('template.layouts.common-layout')
@section('page_title')
    News Slider
@endsection


@section('main_content')
    <div class="row px-1 mb-3">
        <div class="col-12 p-md-0">
            <div class="welcome-text px-md-4 px-1">
                <h6>Manage News</h6>
                <span style="font-size: 8pt;">You can upload and delete news</span>
            </div>
        </div>
    </div>
    <div class="row px-1">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="basic-form custom_file_input mb-4">
                        <form method="POST" action="{{ route('news_slider.create') }}">
                            @csrf
                            @method('POST')
                            <div class="input-group">
                                <input type="text" class="form-control input-rounded " name="news" id="newsInputField"
                                    placeholder="Type..." required>
                                <div class="input-group-append">
                                    <button class="btn btn-info custom-input-group-btn" type="submit"><i
                                            class="fa-solid fa-plus"></i>&nbsp;Save
                                    </button>
                                </div>
                            </div>


                        </form>
                    </div>
                    @if (count($allNews) < 1)
                        <p class="text-info"><small>You haven't add any news yet!</small></p>
                    @else
                        <ul class="list-group">
                            @foreach ($allNews as $single)
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center px-2 pb-0 pt-1">
                                    <p class="text-left p-0">
                                        {{ $single->news }}
                                    </p>
                                    <form action="{{ route('news_slider.delete', ['id' => $single->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger shadow btn-xs sharp delete">
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
