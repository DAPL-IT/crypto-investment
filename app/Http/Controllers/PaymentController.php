<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Traits\AlertTrait;
use App\Traits\HelperTrait;
use App\Models\Deposit;
use App\Models\PaymentGateway;
use App\Models\UserTransactionBrief;
use App\Models\Withdraw;
use Exception;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PaymentController extends Controller
{
    use AlertTrait, HelperTrait;

    public function index(): View
    {
        $paymentGateway = PaymentGateway::orderBy('id', 'asc')->first();
        return view('deposit.index', compact(['paymentGateway']));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'amount' => 'required|numeric',
                'transaction_id' => 'required|unique:deposits',
                'screenshot' => 'required|image|mimes:png,jpg,jpeg|min:1|max:5121',
            ],
            [
                'screenshot.required' => 'Screenshot input field is required',
                'screenshot.min' => 'Invalid image',
                'screenshot.max' => 'Maximum 5Mb image size is allowed',
                'transaction_id.required' => 'TransactionID input field is required',
            ]
        );

        $paymentGateway = PaymentGateway::orderBy('id', 'asc')->first();

        $reqFile = $request->file('screenshot');
        $fileName = pathinfo($reqFile->getClientOriginalName(), PATHINFO_FILENAME);
        $fileExtension = strtolower($reqFile->getClientOriginalExtension());
        $newFileName = $this->generateFileName($fileName, $fileExtension);
        $fileDir = Deposit::SCREENSHOT_DIR;

        $deposit = new Deposit();
        $deposit->screenshot_dir =  $fileDir;
        $deposit->screenshot_file_name = $newFileName;
        $deposit->amount = $request->amount;
        $deposit->user_id = Auth::user()->id;
        $deposit->transaction_id = $request->transaction_id;
        $deposit->payment_gateway_id = $paymentGateway->id;

        try {
            Image::make($reqFile)
                ->resize(375, 667)
                ->encode($fileExtension, 85)
                ->save($fileDir . $newFileName);
        } catch (Exception $e) {
            return back()->with($this->errorAlert('Failed to upload!'));
        }

        $deposit->save();
        return back()->with($this->successAlert('Successfully requested!'));
    }

    public function withdrawIndex ()
    {
        return view('withdraw.index');
    }

    public function withdrawStore (Request $request)
    {
        $request->validate(
            [
                'amount' => 'required|numeric',
                'payment_contact' => 'required',
            ],
            [
                'payment_contact.required' => 'Wallet address input field is required',
            ]
        );

        $paymentGateway = PaymentGateway::orderBy('id', 'asc')->first();
        $authUserId = Auth::user()->id;
        $transactionBrief = UserTransactionBrief::where('user_id', $authUserId)->first();

        if($transactionBrief != null){
            if($transactionBrief->total_earning >= $request->amount){
                $withdraw = new Withdraw();
                $withdraw->amount = $request->amount;
                $withdraw->user_id = $authUserId;
                $withdraw->payment_contact = $request->payment_contact;
                $withdraw->payment_gateway_id = $paymentGateway->id;
        
                $withdraw->save();
                return back()->with($this->successAlert('Successfully requested!'));
            }
            else{
                return back()->with($this->errorAlert('Insufficient balance!'));
            }
        }

        else{
            return back()->with($this->errorAlert('Insufficient balance!'));
        }
    }
}
