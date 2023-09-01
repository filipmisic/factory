<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Rules\ValidateTagsRule;
use App\Rules\ValidateWithRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;


class FoodController extends Controller
{
    public $food;
    public function __construct()
    {
         $this->food= new Food();
    }
    public function filter(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'per_page' => ['sometimes','numeric','min:1','max:10'],
            'tags' => ['sometimes',new ValidateTagsRule()],
            'category' => ['sometimes'],
            'diff_time' => ['sometimes','numeric','min:0'],
            'page' => ['sometimes','numeric','min:1'],
            'with' => ['sometimes',new ValidateWithRule()],
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),400);
        }

        $this->food=$this->food->withTranslation();

        if(isset($request->category))
        {
            switch ($request->category){
                case "NULL":
                    $this->food=$this->food->where('category_id',NULL);
                    break;
                case "!NULL":
                    $this->food=$this->food->whereNotNull('category_id');
                    break;
                default:
                    $this->food=$this->food->where('category_id',$request->category);
            }
        }
        if(isset($request->diff_time))
        {
            $this->food=$this->food->withTrashed();
        }

        if(isset($request->tags))
        {
            $tags = explode(',',$request->tags);
            $this->food=$this->food->whereHas('tags', function (Builder $query) use ($tags) {
                foreach ($tags as $tag) {
                    $query->where('tag_id',$tag);
                }
            });
        }
        if(isset($request->with))
        {
            $withs = explode(',',$request->with);
            foreach($withs as $with)
            {
                $this->food=$this->food->with($with,function($query){
                    $query->withTranslation();
                });
            }

        }

        $this->food=$this->food->paginate($request->per_page ? $request->per_page : 5)->appends($request->except(['page']))->toArray();

        return response()->json([
            "meta" =>
                [
                    "currentPage" => $this->food["current_page"],
                    "totalItems"=>$this->food["total"],
                    "itemsPerPage" => $this->food["per_page"],
                    "totalPages" => $this->food["last_page"]
                    
                ],
            "data" =>$this->food["data"],
            "links"=>
                [
                    "prev"=> $this->food["prev_page_url"],
                    "self"=> url()->full(),
                    "next" => $this->food["next_page_url"]
                ]
        ],200)  ;
    }
}
