<?php

namespace App\Http\Resources;

use App\Models\ToDoList;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $users = [];
        $users['id'] = $this->id;
        $users['username'] = $this->username;
        $users['email'] = $this->email;
        $users['status'] = $this->status;
        // $users['lists'] = ToDoListResource::make($this->toDoLists)->all();
        // $users['tasks'] = TaskResource::make($this->tasks)->all();

        return $users;
    }
}
// [
//     'id' => $this->id,
//     'username' => $this->username,
//     'email' => $this->email,
//     'status' => $this->status,
//  ];