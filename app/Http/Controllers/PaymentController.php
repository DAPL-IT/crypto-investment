<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Traits\AlertTrait;
use App\Traits\HelperTrait;
use App\Models\Deposit;
use Exception;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PaymentController extends Controller
{
    use AlertTrait, HelperTrait;

    public function index(): View
    {
        return view('deposit.index');
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
        $deposit->payment_gateway_id = 1;

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
}
