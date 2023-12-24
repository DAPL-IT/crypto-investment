@extends('template.layouts.common-layout')
@section('page_title')
    Tasks
@endsection


@section('main_content')
    <div class="row px-1 mb-3">
        <div class="col-12 p-md-0">
            <div class="welcome-text px-md-4 px-1">
                <h6>Tasks</h6>
                {{-- <span style="font-size: 8pt;">All Tasks</span> --}}
            </div>
        </div>
    </div>
    <div class="row px-1">
        @if ($user->user_transaction_brief != null && $user->user_transaction_brief->total_deposit > 0)
        @foreach ($tasks as $task)
        @php
            $today = Carbon\Carbon::now()->startOfDay();
            $taskRecord = App\Models\TaskRecord::where('user_id', $user->id)->where('task_id', $task->id)->whereDate('created_at', $today)->first();
        @endphp
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    @if ($taskRecord == null)
                    <div class="row">
                        <div class="col-12">
                            <h6>{{$task->title}}</h6>
                        </div>
                        <div class="col-md-3">
                            <img src="{{asset('images/tasks/'.$task->image)}}"
                                alt="" class="img img-fluid">
                        </div>
                        <div class="col-md-9 mt-md-0 mt-2">
                            <div>
                                <small>{!!$task->short_description!!}</small>
                            </div>
                            {{-- <div>
                                <small><b>$14.5 X 5</b></small>
                            </div> --}}

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="pt-0 profile-personal-info">
                                <div class="row mb-0">
                                    <div class="col-sm-4 col-6">
                                        <p class="f-w-500 pb-0 mb-0">
                                            <small>Order Number</small>
                                            <small class="pull-right">:</small>
                                        </p>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        @php
                                            $orderNumber = rand(10000, 100000000);
                                            $currentDateTime = Carbon\Carbon::now()->format('Y-m-d H:i');
                                        @endphp
                                        <small>{{$orderNumber}}</small>
                                    </div>
                                </div>
                                <div class="row mb-0">
                                    <div class="col-sm-4 col-6">
                                        <p class="f-w-500 pb-0 mb-0">
                                            <small>Order Time</small>
                                            <small class="pull-right">:</small>
                                        </p>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <small>{{$currentDateTime}}</small>
                                    </div>
                                </div>
                                <div class="row mb-0">
                                    <div class="col-sm-4 col-6">
                                        <p class="f-w-500 pb-0 mb-0">
                                            <small>Order Total</small>
                                            <small class="pull-right">:</small>
                                        </p>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <small>${{$task->order_total}}</small>
                                    </div>
                                </div>
                                {{-- <div class="row mb-0">
                                    <div class="col-sm-4 col-6">
                                        <p class="f-w-500 pb-0 mb-0">
                                            <small>Comission Fee</small>
                                            <small class="pull-right">:</small>
                                        </p>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        <small>$1</small>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-12 mt-3">
                            @if ($taskRecord != null)
                            <a class="btn btn-sm btn-success">Completed</a>
                            @else
                            <a href="{{ url('tasks/complete/'.$task->id) }}" class="btn btn-sm btn-primary">Grab Now</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="col-lg-12 col-md-12">
            <div class="card text-center">
                <h3 style="color: red">Not available for you!!</h3>
                <span style="color: green">Please make a deposit first.</span>
            </div>
        </div>
        @endif
    </div>

    {{-- <div class="row px-1">
        <nav class="col-12" style="display: flex; justify-content: center; ">
            <ul class="pagination pagination-sm">
                <li class="page-item page-indicator">
                    <a class="page-link" href="javascript:void(0)">
                        <i class="la la-angle-left"></i></a>
                </li>
                <li class="page-item active"><a class="page-link" href="javascript:void(0)">1</a>
                </li>
                <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0)">4</a></li>
                <li class="page-item page-indicator">
                    <a class="page-link" href="javascript:void(0)">
                        <i class="la la-angle-right"></i></a>
                </li>
            </ul>
        </nav>
    </div> --}}
@endsection
