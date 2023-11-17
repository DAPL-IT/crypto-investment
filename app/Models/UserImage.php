<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserImage extends Model
{
    use HasFactory;

    const IMAGE_DIR = 'images/users/image/';

    protected $fillable = [
        'image_dir',
        'file_name',
        'user_id'
    ];

    protected $hidden = [
        'image_dir'
    ];

    protected $appends = ['image_full_path'];

    protected function imageFullPath(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->attributes['image_dir'] . $this->attributes['file_name'],
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
