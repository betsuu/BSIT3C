<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    //
    protected $table = 'todo';
    protected $fillable = ['user_id', 'task', 'location', 'time', 'profile_pic', 'address', 'birthday', 'gender', 'bio', 'is_done'];

    protected $casts = [
        'is_done' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}