<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ToDoListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lists = [];
        $lists['id'] = $this->id;
        $lists['name'] = $this->name;
        $lists['description'] = $this->description;
        $lists['status'] = $this->status;
        $lists['user_id'] = $this->user_id;
        // $lists['user'] = new UserResource($this->user);
        $lists['tasks'] = TaskResource::make($this->tasks)->all();
        return $lists;
    }
}

// return [
//     'id' => $this->id,
//     'name' => $this->name,
//     'description' => $this->description,
//     'status' => $this->status,
//     'user_id' => $this->user_id,
//     'user' => UserResource::make($this->user),
// ];