<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'phone',
        'whatsapp',
        'password',
        'is_active',
        'is_online',
        'account_type',
        'inviter_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function user_profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    public function user_image()
    {
        return $this->hasOne(UserImage::class, 'user_id', 'id');
    }

    public function user_invitation_code()
    {
        return $this->hasOne(UserInvitationCode::class, 'user_id', 'id');
    }

    public function user_transaction_brief()
    {
        return $this->hasOne(UserTransactionBrief::class, 'user_id', 'id');
    }

    public function deposit()
    {
        return $this->hasMany(Deposit::class, 'user_id', 'id')
            ->with('payment_gateway');
    }

    public function withdraw()
    {
        return $this->hasMany(Withdraw::class, 'user_id', 'id')
            ->with('payment_gateway');
    }

    public function isSuperAdmin()
    {
        return $this->attributes['account_type'] === 'super_admin';
    }

    public function isAdmin()
    {
        return $this->attributes['account_type'] === 'admin';
    }
}
