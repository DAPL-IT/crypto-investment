<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\AlertTrait;
use App\Models\User;
use App\Models\Commission;
use App\Models\UserTransactionBrief;

class CommissionConotroller extends Controller
{
    use AlertTrait;

    public function commissionForm ($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('pages.commission.form', compact(['user']));
    }

    public function store (Request $request)
    {
        $request->validate(
            [
                'amount' => 'required|numeric',
                'commission_type' => 'required',
            ],
            [
                'commission_type.required' => 'Select a commission type',
                'amount.required' => 'Give an amount',
                'amount.numeric' => 'Give a valid amount',
            ]
        );

        return DB::transaction(function () use ($request) {
            $commission = new Commission();
            $commission->user_id = $request->user_id;
            $commission->amount = $request->amount;
            $commission->commission_type = $request->commission_type;

            $transaction_brief = UserTransactionBrief::where('user_id', $request->user_id)->first();
                if ($transaction_brief != null) {
                    $transaction_brief->total_earning += $request->amount;
                    $transaction_brief->total_successful_transaction += 1;
                    $transaction_brief->save();
                    $commission->save();
                    return back()->with($this->successAlert('Commission is given successfully!'));
                } else {
                    $transaction_brief = new UserTransactionBrief();
                    $transaction_brief->user_id = $request->user_id;
                    $transaction_brief->total_earning = $request->amount;
                    $transaction_brief->total_successful_transaction = 1;
                    $transaction_brief->save();
                    $commission->save();
                    return back()->with($this->successAlert('Commission is given successfully!'));
                }
        });
    }
}
