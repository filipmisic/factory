<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Tag extends Model implements TranslatableContract
{
    use HasFactory,Translatable;
    protected $table = 'tags';
    public $translatedAttributes = ['title'];
    protected $fillable = [
        'slug',
        'food_id'
    ];
    public function foods()
    {
        return $this->belongsToMany('App\Models\Food', 'tag_food', 'tag_id', 'food_id');
    }
    public function tagTranslation()
    {
        return $this->hasMany('App\Models\TagTranslation','tag_id');
    }
}
