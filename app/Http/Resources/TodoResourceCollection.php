<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TodoResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'message' => '',
            'data' => $this->collection->transform(function ($todo){
                return [
                    'id' => $todo->id,
                    'title' => $todo->title,
                    'is_completed' => $todo->is_completed
                ];
            })
        ];
    }
}
