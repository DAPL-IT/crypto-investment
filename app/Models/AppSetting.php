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
    const BACKGROUND_DIR = 'images/site/background/';

    protected $fillable = [
        'app_name',
        'icon_dir',
        'icon_file_name',
        'background_image_dir',
        'background_image_file_name'
    ];

    protected $hidden = ['icon_dir', 'background_image_dir'];

    protected $appends = ['icon_full_path', 'background_image_full_path'];

    protected function iconFullPath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->attributes['icon_dir'] . $this->attributes['icon_file_name'],
        );
    }

    protected function backgroundImageFullPath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->attributes['background_image_dir'] . $this->attributes['background_image_file_name'],
        );
    }
}
