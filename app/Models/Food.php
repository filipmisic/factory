<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model implements TranslatableContract
{

    use HasFactory,SoftDeletes,Translatable;
    protected $table = 'food';
    public $translatedAttributes = ['title','description'];
    protected $fillable = [
        'category_id',
    ];
    public function foodTranslation()
    {
        return $this->hasMany('App\Models\FoodTranslation','food_id');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }
    public function ingredients()
    {
        return $this->belongsToMany('App\Models\Ingredient', 'ingredient_food', 'food_id', 'ingredient_id');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'tag_food', 'food_id', 'tag_id');
    }

}
