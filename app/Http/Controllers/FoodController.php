<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodFilterRequest;
use App\Http\Resources\FoodCollection;
use App\Models\Food;
use Illuminate\Database\Eloquent\Builder;


class FoodController extends Controller
{
    public $food;
    public function __construct()
    {
         $this->food= new Food();
         $this->food=$this->food->withTranslation();
    }
    
    public function search(FoodFilterRequest $request)
    {
        $this->filter($request);
        $this->joinOptional($request);
        return response(new FoodCollection($this->food->paginate($request->per_page ? $request->per_page : 5)->appends($request->except(['page']))->toArray()),200);
    }


    protected function filter($request){
        if(isset($request->category))
        {
            $this->filterCategory($request->category,$this->food);
        }

        if(isset($request->tags))
        {
            $this->filterTags($request->tags,$this->food);
        }
    }

    protected function joinOptional($request){

        if(isset($request->diff_time))
        {
            $this->food=$this->food->withTrashed();
        }
       
        if(isset($request->with))
        {
            $this->loadWiths($request->with,$this->food);
        }
    }


    protected function filterCategory($category)
    {
        switch ($category){
            case "NULL":
                $this->food = $this->food->where('category_id',NULL);
                break;
            case "!NULL":
                $this->food = $this->food->whereNotNull('category_id');
                break;
            default:
                $this->food = $this->food->where('category_id',$category);
        }
    }

    protected function filterTags($tags)
    {
        $tags = explode(',',$tags);
        foreach ($tags as $tag) {
            $this->food = $this->food->whereHas('tags', function (Builder $query) use ($tag) {
                    $query->where('tag_id',$tag);
            });
        }
    }

    protected function loadWiths($withs)
    {
        $withs = explode(',',$withs);
        foreach($withs as $with)
        {
            $this->food = $this->food->with($with,function($query){
                $query->withTranslation();
            });
        }
    }
}
