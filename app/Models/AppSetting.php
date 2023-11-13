<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class AppSetting extends Model
{
    use HasFactory, SoftDeletes;

    const ICON_DIR = 'images/site/icon/';

    protected $fillable = [
        'app_name',
        'icon_dir',
        'icon_file_name'
    ];

    protected $hidden = ['icon_dir'];

    protected $appends = ['icon_full_path'];

    protected function iconFullPath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->attributes['icon_dir'] . $this->attributes['icon_file_name'],
        );
    }
}
