<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'to_do_list_id',
        'user_id',

    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function toDoList()
    {
        return $this->belongsTo(ToDoList::class);
    }

    public function getTask($curTask)
    {
        $user = Auth::user();
        if ($curTask->user_id == $user->id || $curTask->status == 1) {

            return true;
        }
        return false;
    }

    // public function getTasks($id)
    // {
    //     // ToDoList::find($id);
    //     $tasks = $this->toDoList->toArray();
    //     dd($tasks);
    // }
}
