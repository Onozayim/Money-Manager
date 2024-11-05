<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'user_id',
        'sub_category_id',
        'description',
        'category_id',
        'period',
        'month',
        'year'
    ];

    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function sub_category() {
        return $this->hasOne(SubCategory::class, 'id', 'sub_category_id');
    }
}
