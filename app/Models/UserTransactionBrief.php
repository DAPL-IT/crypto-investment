<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTransactionBrief extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'total_earning',
        'total_deposit',
        'total_withdraw',
        'total_successful_transaction',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
