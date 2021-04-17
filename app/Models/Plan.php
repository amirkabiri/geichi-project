<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'barbers_count', 'prepayment'];
    protected $casts = [
        'prepayment' => 'boolean',
        'barbers_count' => 'integer',
        'price' => 'integer',
    ];
}
