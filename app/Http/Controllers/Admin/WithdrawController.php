<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\AlertTrait;
use App\Models\Withdraw;
use App\Models\UserTransactionBrief;

class WithdrawController extends Controller
{
    use AlertTrait;

    public function index ()
    {
        $allRequests = Withdraw::orderBy('id', 'desc')->with('user')->paginate(10);
        return view('pages.withdraw.index', compact(['allRequests']));
    }

    public function details ($id)
    {
        $withdraw = Withdraw::where('id', $id)->with('user')->first();
        return view('pages.withdraw.details', compact(['withdraw']));
    }

    public function approve ($id)
    {
        return DB::transaction(function () use ($id) {
            $withdraw = Withdraw::where('id', $id)->with('user')->first();

            if ($withdraw != null) {
                if ($withdraw->withdraw_status == 1) {
                    return back()->with($this->errorAlert('Already Approved!'));
                } else {
                    $transaction_brief = UserTransactionBrief::where('user_id', $withdraw->user->id)->first();
                    if ($transaction_brief != null) {
                        $transaction_brief->total_withdraw += $withdraw->amount;
                        $transaction_brief->total_earning -= $withdraw->amount;
                        $transaction_brief->total_successful_transaction += 1;
                        $transaction_brief->save();

                        $withdraw->withdraw_status = 1;
                        $withdraw->save();

                        return back()->with($this->successAlert('Approved Successfully!'));
                    } else {
                        $transaction_brief = new UserTransactionBrief();
                        $transaction_brief->user_id = $withdraw->user->id;
                        $transaction_brief->total_withdraw = $withdraw->amount;
                        $transaction_brief->save();

                        $withdraw->withdraw_status = 1;
                        $withdraw->save();

                        return back()->with($this->successAlert('Approved Successfully!'));
                    }
                }
            } else {
                return back()->with($this->errorAlert('Data not found!'));
            }
        });
    }

    public function reject ($id)
    {
        $withdraw = Withdraw::where('id', $id)->with('user')->first();

        if ($withdraw != null) {
            if ($withdraw->withdraw_status == 0) {
                return back()->with($this->errorAlert('Already Rejected!'));
            } elseif ($withdraw->withdraw_status == 1) {
                return back()->with($this->errorAlert('Already Approved!'));
            } else {
                $withdraw->withdraw_status = 0;
                $withdraw->save();

                return back()->with($this->successAlert('Rejected Successfully!'));
            }
        } else {
            return back()->with($this->errorAlert('Data not found!'));
        }
    }
}
