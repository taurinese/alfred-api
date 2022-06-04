<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'title',
        'agency',
        'description',
        'city',
        'price',
        'images_url',
        'status_id'
    ];
}
