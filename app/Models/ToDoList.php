<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ToDoList extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'status',
        'user_id',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function tasks()
    {
        $user = Auth::user();

        return $this->hasMany(Task::class)->where('status', '=', '1')->orWhere('user_id', '=', $user->id)->orderBy('ended_at');
    }



    public function getList($list)
    {
        $user = Auth::user();
        if ($list->user_id == $user->id || $list->status == 1) {

            return true;
        }
        return false;
    }
}
