<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model implements TranslatableContract
{
    use HasFactory,Translatable;
    protected $table = 'categories';
    public $translatedAttributes = ['title'];
    protected $fillable = [
        'slug',
    ];
    public function categoryTranslation()
    {
        return $this->hasMany('App\Models\CategoryTranslation','category_id');
    }
    public function food()
    {
        return $this->hasMany('App\Models\Food','category_id');
    }
}
