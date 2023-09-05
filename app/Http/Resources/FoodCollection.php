<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FoodCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "meta" =>
                [
                    "currentPage" => $this->collection["current_page"],
                    "totalItems"=>$this->collection["total"],
                    "itemsPerPage" => $this->collection["per_page"],
                    "totalPages" => $this->collection["last_page"]
                    
                ],
            "data" =>$this->collection["data"],
            "links"=>
                [
                    "prev"=> $this->collection["prev_page_url"],
                    "self"=> url()->full(),
                    "next" => $this->collection["next_page_url"]
                ]
        ];
    }
}
