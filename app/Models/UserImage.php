<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserImage extends Model
{
    use HasFactory;

    const THUMB_DIR = 'images/users/thumbnails/';
    const ICON_DIR = 'images/users/icons/';

    protected $fillable = [
        'thumb_size_dir',
        'icon_size_dir',
        'file_name',
        'user_id'
    ];

    protected $hidden = [
        'icon_size_dir',
        'thumb_size_dir'
    ];

    protected $appends = ['thumb_full_path', 'icon_full_path'];

    protected function thumbFullPath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->attributes['thumb_size_dir'] . $this->attributes['file_name'],
        );
    }

    protected function iconFullPath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->attributes['icon_size_dir'] . $this->attributes['file_name'],
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
