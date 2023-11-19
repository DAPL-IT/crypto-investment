@extends('template.layouts.common-layout')
@section('page_title')
    Commission
@endsection


@section('main_content')
    <div class="row px-1 mb-3">
        <div class="col-12 p-md-0">
            <div class="welcome-text px-md-4 px-1">
                <h6>Provide Commission</h6>
                <span style="font-size: 8pt;">You can provide commission to this user</span>
            </div>
        </div>
    </div>
    <div class="row px-1">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form custom_file_input mb-4">
                        <form method="POST" action="{{ route('commission.store') }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label class="mb-2 pl-1"><small><b>UserID</b></small></label>
                                <input type="text" class="form-control" value="{{ $user->username }}" name="username" step="0.1" required
                                    autocomplete="off" readonly>
                                <input type="hidden" value="{{ $user->id }}" name="user_id">
                            </div>
                            <div class="form-group">
                                <label class="mb-2 pl-1"><small><b>Commission Amount</b></small></label>
                                <input type="number" class="form-control" name="amount" step="0.1" required
                                    autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <label class="mb-2 pl-1"><small><b>Commission Type</b></small></label>
                                <select class="form-control" name="commission_type" required>
                                    <option selected disabled>Select Type</option>
                                    <option value="1">Invitation</option>
                                    <option value="2">Deposit</option>
                                </select>
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
