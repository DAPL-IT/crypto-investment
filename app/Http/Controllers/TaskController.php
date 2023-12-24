<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskRecord;
use App\Models\UserTransactionBrief;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\AlertTrait;
use App\Traits\HelperTrait;
use Carbon\Carbon;

class TaskController extends Controller
{
    use AlertTrait, HelperTrait;

    public function index()
    {
        $user = User::where('id', Auth::user()->id)->with('user_transaction_brief')->first();
        $tasks = Task::paginate(5);
        return view('pages.task.index', compact('tasks', 'user'));
    }

    public function grabTask ($id)
    {
        $task = Task::find($id);

        if($task != null){
            $today = Carbon::now()->startOfDay();
            $taskRecord = TaskRecord::where('task_id', $id)->where('user_id', Auth::user()->id)->whereDate('created_at', $today)->first();
            if($taskRecord != null){
                return back()->with($this->errorAlert('Already Completed!'));
            }

            //Calculate Cimmission
            $userTransactionRecord = UserTransactionBrief::where('user_id', Auth::user()->id)->first();
            $totalDeposit = $userTransactionRecord->total_deposit;
            $percentage = $totalDeposit * 0.00416;
            $commission = round($percentage, 2);
            //Calculate Cimmission

            $task_record = new TaskRecord();
            $task_record->task_id = $id;
            $task_record->user_id = Auth::user()->id;
            $task_record->commission = $commission;

            $transactionRecord = UserTransactionBrief::where('user_id', Auth::user()->id)->first();
            $transactionRecord->total_earning = $transactionRecord->total_earning + $commission;

            $transactionRecord->save();
            $task_record->save();
            return back()->with($this->successAlert('Completed!'));
        }

        else{
            return back()->with($this->errorAlert('Failed to complete!'));
        }
    }
}
