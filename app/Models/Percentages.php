<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Percentages extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'percentage'
    ];

    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
