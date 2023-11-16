@extends('template.layouts.common-layout')
@section('page_title')
    Deposit
@endsection


@section('main_content')
    <div class="row px-1 mb-3">
        <div class="col-12 p-md-0">
            <div class="welcome-text px-md-4 px-1">
                <h6>Make a Deposit Request</h6>
                <span style="font-size: 8pt;">You can deposit via Binance Wallet</span>
            </div>
        </div>
    </div>
    <div class="row px-1">
        <div class="col-12 d-flex justify-content-center">
            <div class="card">
                <div class="card-body">
                    <img class="img-fluid img-thumbnail" src="{{ asset('images/assets/binance_qr.png') }}">
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
                            <div class="form-group">
                                <label class="mb-2 pl-1"><small><b>Deposit Amount</b></small></label>
                                <input type="number" class="form-control" name="amount" step="0.1" required
                                    autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <label class="mb-2 pl-1"><small><b>Transaction ID</b></small></label>
                                <input type="text" class="form-control" name="transaction_id" required
                                    autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <label class="mb-2 pl-1"><small><b>Screenshot</b></small></label>
                                <input type="file" class="form-control" name="screenshot" accept=".jpg, .jpeg, .png"
                                    required autocomplete="off">
                                <small class="form-text pt-1">Maximum image size allowed: 5Mb</small>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-xs btn-info" type="submit"><i
                                        class="fa-solid fa-plus"></i>&ensp;Submit
                                </button>
                            </div>
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
