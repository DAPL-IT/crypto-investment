@extends('template.layouts.common-layout')
@section('page_title')
    Deposit Details
@endsection


@section('main_content')
    <div class="row px-1 mb-3">
        <div class="col-12 p-md-0">
            <div class="welcome-text px-md-4 px-1">
                <h6>Manage Deposit</h6>
                <span style="font-size: 8pt;">Manage Deposit Request</span>
            </div>
        </div>
    </div>
    <div class="row px-1">
        <div class="col-12">
            <div class="profile card card-body px-3 pt-3 pb-0">
                <div class="profile-head">
                    <div class="profile-info">
                        <div>
                            @if ($deposit->user->user_image)
                                <img style="width: 80px" src="{{ asset($deposit->user->user_image->image_full_path) }}"
                                    class="img-fluid rounded" alt="{{ $deposit->user->username }}" />
                            @else
                                <img style="width: 80px"
                                    src="https://ui-avatars.com/api/?name={{ $deposit->user->username }}&background=f3f3f3&color=444444"
                                    class="img-fluid rounded" alt="{{ $deposit->user->username }}" />
                            @endif
                        </div>
                        <div class="profile-details">
                            <div class="profile-name px-3 pt-2">
                                <h4 class="text-primary mb-0">{{ $deposit->user->username }}</h4>
                                <p class="text-lowercase">{{ $deposit->user->account_type }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-body px-3 py-3">
                <div class="row">
                    <div class="col-12">
                        <p><strong>Amount:</strong> {{ $deposit->amount }}</p>
                    </div>
                    <div class="col-12">
                        <p><strong>Transaction ID:</strong> {{ $deposit->transaction_id }}</p>
                    </div>
                    <div class="col-12">
                        <img style="max-width: 375px;" class="img-thumbnail img-fluid col-sm-11 col-xs-10"
                            src="{{ asset($deposit->screenshotFullPath) }}">
                    </div>
                    <div class="col-12 mt-3">
                        @if ($deposit->deposit_status == 2)
                            <script>
                                function confirmAction(action) {
                                    return confirm('Are you sure you want to ' + action + '?');
                                }
                            </script>

                            <a href="{{ route('deposit.approve', ['id' => $deposit->id]) }}"
                                onclick="return confirmAction('approve');" class="btn btn-success btn-xs">Approve</a>
                            <a href="{{ route('deposit.reject', ['id' => $deposit->id]) }}"
                                onclick="return confirmAction('reject');" class="btn btn-danger btn-xs">Reject</a>
                        @elseif ($deposit->deposit_status == 1)
                            <a href="#" class="btn btn-success btn-xs">Approved</a>
                        @elseif ($deposit->deposit_status == 0)
                            <script>
                                function confirmAction(action) {
                                    return confirm('Are you sure you want to ' + action + '?');
                                }
                            </script>
                            <a href="{{ route('deposit.approve', ['id' => $deposit->id]) }}"
                                onclick="return confirmAction('approve');" class="btn btn-primary btn-xs">Approve</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
