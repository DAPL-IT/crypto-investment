<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AlertTrait;
use App\Models\Deposit;
use App\Models\UserTransactionBrief;

class DepositController extends Controller
{
    use AlertTrait;

    public function index(): View
    {
        $allRequests = Deposit::orderBy('id', 'desc')->with('user')->paginate(10);
        return view('pages.deposit.index', compact(['allRequests']));
    }

    public function details($id)
    {
        $deposit = Deposit::where('id', $id)->with('user')->first();
        return view('pages.deposit.details', compact(['deposit']));
    }

    public function approve($id)
    {
        return DB::transaction(function () use ($id) {
            $deposit = Deposit::where('id', $id)->with('user')->first();

            if ($deposit != null) {
                if ($deposit->deposit_status == 1) {
                    return back()->with($this->errorAlert('Already Approved!'));
                } else {
                    $transaction_brief = UserTransactionBrief::where('user_id', $deposit->user->id)->first();
                    if ($transaction_brief != null) {
                        $transaction_brief->total_deposit += $deposit->amount;
                        $transaction_brief->save();

                        $deposit->deposit_status = 1;
                        $deposit->save();

                        return back()->with($this->successAlert('Approved Successfully!'));
                    } else {
                        $transaction_brief = new UserTransactionBrief();
                        $transaction_brief->user_id = $deposit->user->id;
                        $transaction_brief->total_deposit = $deposit->amount;
                        $transaction_brief->save();

                        $deposit->deposit_status = 1;
                        $deposit->save();

                        return back()->with($this->successAlert('Approved Successfully!'));
                    }
                }
            } else {
                return back()->with($this->errorAlert('Data not found!'));
            }
        });
    }

    public function reject($id)
    {
        $deposit = Deposit::where('id', $id)->with('user')->first();

        if ($deposit != null) {
            if ($deposit->deposit_status == 0) {
                return back()->with($this->errorAlert('Already Rejected!'));
            } elseif ($deposit->deposit_status == 1) {
                return back()->with($this->errorAlert('Already Approved!'));
            } else {
                $deposit->deposit_status = 0;
                $deposit->save();

                return back()->with($this->successAlert('Rejected Successfully!'));
            }
        } else {
            return back()->with($this->errorAlert('Data not found!'));
        }
    }
}
