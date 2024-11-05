<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linear extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'user_id',
        'pendiente',
        'interseccion', 
        'num'
    ];
}
