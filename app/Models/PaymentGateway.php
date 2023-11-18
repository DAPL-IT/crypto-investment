<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PaymentGateway extends Model
{
    use HasFactory, SoftDeletes;

    const QRCODE_DIR = 'images/site/gateway/qrcode/';

    protected $fillable = [
        'name',
        'name_slug',
        'code',
        'qrcode_dir',
        'qrcode_file_name'
    ];

    protected $hidden = ['qrcode_dir'];

    protected $appends = ['qrcode_full_path'];

    protected function qrcodeFullPath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->attributes['qrcode_dir'] . $this->attributes['qrcode_file_name'],
        );
    }
}
