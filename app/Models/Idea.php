<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    protected $fillable = [
<<<<<<< HEAD
=======
        'user_id',
>>>>>>> 0fd01d3 (updated code)
        'content',
        'like',

    ];
<<<<<<< HEAD
=======

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
>>>>>>> 0fd01d3 (updated code)
}
