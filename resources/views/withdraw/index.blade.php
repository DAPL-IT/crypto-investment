@extends('template.layouts.common-layout')
@section('page_title')
    Deposit
@endsection


@section('main_content')
    <div class="row px-1 mb-3">
        <div class="col-12 p-md-0">
            <div class="welcome-text px-md-4 px-1">
                <h6>Make a Withdraw Request</h6>
                <span style="font-size: 8pt;">You can withdraw via Binance Wallet</span>
            </div>
        </div>
    </div>
    <div class="row px-1">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form custom_file_input mb-4">
                        <form method="POST" action="{{ route('withdraw.store') }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label class="mb-2 pl-1"><small><b>Withdraw Amount</b></small></label>
                                <input type="number" class="form-control" name="amount" step="0.1" required
                                    autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <label class="mb-2 pl-1"><small><b>Wallet Address</b></small></label>
                                <input type="text" class="form-control" name="payment_contact" required
                                    autocomplete="off">
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
        function copyText() {
            const walletAddress = document.getElementById('walletAddress');
            const textArea = document.createElement('textarea');
            textArea.value = walletAddress.textContent;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            toastr.success("Copied to clipboard!")
        }
    </script>
@endsection
