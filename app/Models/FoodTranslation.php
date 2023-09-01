<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodTranslation extends Model
{
    use HasFactory;
    protected $table = 'food_translations';
    protected $fillable = [
        'title',
        'description',
        'locale',
        'food_id'
    ];
}
