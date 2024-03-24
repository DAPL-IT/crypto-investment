@extends('template.layouts.common-layout')
@section('page_title')
    Transactions
@endsection


@section('main_content')
    <div class="row px-1 mb-3">
        <div class="col-12 p-md-0">
            <div class="welcome-text px-md-4 px-1">
                <h6>Transactions History</h6>
            </div>
        </div>
    </div>
    <div class="row px-1">
        <div class="col-6">
            <h3>Deposit history</h3>
            <div class="card">
                <div class="card-body">
                    @if (count($deposits) < 1)
                        <p class="text-info"><small>No Deposit History!</small></p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Amount</th>
                                    <th>TransactionID</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deposits as $request)
                                    <tr>
                                        <td>{{ $request->amount }}</td>
                                        <td>{{ $request->transaction_id }}</td>
                                        <td>
                                            @if ($request->deposit_status == 2)
                                                <span class="badge bg-warning text-white">Pending</span>
                                            @elseif ($request->deposit_status == 1)
                                                <span class="badge bg-success text-white">Accepted</span>
                                            @else
                                                <span class="badge bg-danger text-white">Rejected</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-6">
            <h3>Withdraw history</h3>
            <div class="card">
                <div class="card-body">
                    @if (count($withdraws) < 1)
                        <p class="text-info"><small>No Withdraw History!</small></p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($withdraws as $request)
                                    <tr>
                                        <td>{{ $request->amount }}</td>
                                        <td>
                                            @if ($request->withdraw_status == 2)
                                                <span class="badge bg-warning text-white">Pending</span>
                                            @elseif ($request->withdraw_status == 1)
                                                <span class="badge bg-success text-white">Accepted</span>
                                            @else
                                                <span class="badge bg-danger text-white">Rejected</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
