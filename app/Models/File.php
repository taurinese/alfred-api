<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use CloudinaryLabs\CloudinaryLaravel\MediaAlly;

class File extends Model
{
    use HasFactory;
    use MediaAlly;

    protected $fillable = [
        'path',
        'user_id',
        'guarantor_id',
        'field_id',
        'cloudinary_id'
    ];
}
