<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'title_ar','period', 'price', 'description','description_ar'];

    protected $casts = [
        'description' => 'array',
    ];
}
