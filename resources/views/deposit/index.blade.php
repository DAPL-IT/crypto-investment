@extends('template.layouts.common-layout')
@section('page_title')
    Deposit
@endsection


@section('main_content')
    <div class="row px-1 mb-3">
        <div class="col-12 p-md-0">
            <div class="welcome-text px-md-4 px-1">
                <h4>Make a Deposit Request</h4>
                <span style="font-size: 8pt;">You can deposit via Binance Wallet</span>
            </div>
        </div>
    </div>
    <div class="row px-1">
        <div class="col-12 d-flex justify-content-center">
            <div class="card">
                <div class="card-body">
                    <img src="{{asset('images/assets/binance_qr.png')}}">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form custom_file_input mb-4">
                        <form method="POST" action="{{ route('banner_slider.create') }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="input-group">
                                <input type="text" class="form-control" name="amount" placeholder="Deposit Amount" required autocomplete="off">
                            </div>
                            <div class="input-group mt-3">
                                <input type="text" class="form-control" name="transaction_id" placeholder="Transaction ID" required autocomplete="off">
                            </div>
                            <div class="input-group mt-3">
                                <input type="file" class="form-control" name="screenshot" accept=".jpg, .jpeg, .png" required autocomplete="off">
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-info custom-input-group-btn" type="submit"><i
                                    class="fa-solid fa-upload"></i>&nbsp;Submit
                                </button>
                            </div>
                            <small class="form-text pt-1">Maximum image size allowed: 5Mb,<br>Recommended dimensions:
                                900x450</small>
                        </form>
                    </div>
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