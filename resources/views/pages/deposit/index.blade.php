@extends('template.layouts.common-layout')
@section('page_title')
Deposit Requests
@endsection


@section('main_content')
<div class="row px-1 mb-3">
    <div class="col-12 p-md-0">
        <div class="welcome-text px-md-4 px-1">
            <h6>Manage Deposit Requests</h6>
            <span style="font-size: 8pt;">Accept or Reject Deposit Requests</span>
        </div>
    </div>
</div>
<div class="row px-1">
    <div class="col-12">
        <div class="card">

            <div class="card-body">
                @if (count($allRequests) < 1) <p class="text-info"><small>No Requests!</small></p>
                    @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Amount</th>
                                <th>TransactionID</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allRequests as $request)
                            <tr>
                                <td>{{ $request->user->username }}</td>
                                <td>{{ $request->amount }}</td>
                                <td>{{ $request->transaction_id }}</td>
                                <td>
                                    @if($request->deposit_status == 2)
                                    <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif ($request->deposit_status == 1)
                                    <span class="badge bg-success">Accepted</span>
                                    @else
                                    <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('deposit.details', ['id' => $request->id]) }}" class="btn btn-primary shadow btn-xs sharp">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $allRequests->links() }}
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
