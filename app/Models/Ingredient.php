<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Ingredient extends Model implements TranslatableContract
{
    use HasFactory,Translatable;
    protected $table = 'ingredients';
    public $translatedAttributes = ['title'];
    protected $fillable = [
        'slug',
        'food_id'
    ];
    public function ingredientTranslation()
    {
        return $this->hasMany('App\Models\IngredientTranslation','ingredient_id');
    }
    public function foods()
    {
        return $this->belongsToMany('App\Models\Food', 'ingredient_food', 'ingredient_id', 'food_id');
    }
}
