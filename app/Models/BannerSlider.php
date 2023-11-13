<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class BannerSlider extends Model
{
    use HasFactory;

    const BANNER_DIR = 'images/banners/dashboard/';

    protected $fillable = [
        'banner_dir',
        'file_name',
        'title',
        'description'
    ];

    protected $hidden = [
        'banner_dir'
    ];

    protected $appends = ['banner_full_path'];

    protected function bannerFullPath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->attributes['banner_dir'] . $this->attributes['file_name'],
        );
    }
}
