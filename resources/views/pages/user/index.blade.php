@extends('template.layouts.common-layout')
@section('page_title')
    Users
@endsection


@section('main_content')
    <div class="row px-1 mb-3">
        <div class="col-12 p-md-0">
            <div class="welcome-text px-md-4 px-1">
                <h6>Manage Users and Provide Commission</h6>
                <span style="font-size: 8pt;">Observe Users</span>
            </div>
        </div>
    </div>
    <div class="row px-1">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    @if (count($users) < 1)
                        <p class="text-info"><small>No Users!</small></p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Reffered by</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            @if ($user->user_image)
                                            <img style="width: 80px" src="{{ asset($user->user_image->image_full_path) }}" class="img-fluid rounded"
                                                alt="{{ $user->username }}" />
                                            {{ $user->username }}
                                            @else
                                            <img style="width: 80px"
                                                src="https://ui-avatars.com/api/?name={{ $user->username }}&background=f3f3f3&color=444444"
                                                class="img-fluid rounded" alt="{{ $user->username }}" />
                                            {{ $user->username }}
                                            @endif
                                        </td>
                                        <td>{{ $user->inviter_id?? 'N.A' }}</td>
                                        <td>
                                            @if ($user->is_active == 0)
                                                <span class="badge bg-warning text-white">Blocked</span>
                                            @elseif ($user->is_active == 1)
                                                <span class="badge bg-success text-white">Unblocked</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('commission.form', ['user_id' => $user->id]) }}">
                                                <span class="badge bg-warning text-white">Commission</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
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
