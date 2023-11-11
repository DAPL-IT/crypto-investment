<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Deposit extends Model
{
    use HasFactory, SoftDeletes;

    const SCREENSHOT_DIR = 'images/deposits/screenshots';

    protected $fillable = [
        'amount',
        'deposit_status',
        'screenshot_dir',
        'screenshot_file_name',
        'payment_gateway_id',
        'transaction_id',
        'user_id'
    ];

    protected $hidden = [
        'screenshot_dir',
        'screenshot_file_name'
    ];

    protected $appends = ['screenshot_full_path'];

    protected function thumbFullPath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->attributes['screenshot_dir'] . '/' . $this->attributes['screenshot_file_name'],
        );
    }

    public function payment_gateway()
    {
        return $this->belongsTo(PaymentGateway::class, 'payment_gateway_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')
            ->with('user_profile', 'user_image');
    }
}
