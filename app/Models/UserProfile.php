<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'date_of_birth',
        'nationality',
        'nid',
        'religion',
        'present_address',
        'permanent_address',
        'user_id',
        'country',
        'city',
        'post_code',
        'police_station'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
