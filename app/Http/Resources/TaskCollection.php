<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return
            [
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'status' => $this->status,
                'toDoList_id' => $this->toDoListId,
                'user_id' => $this->user_id,
                'user' => UserResource::collection($this->user),
            ];
    }
}
