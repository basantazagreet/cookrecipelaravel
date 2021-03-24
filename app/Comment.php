<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Recipe;
use App\User;

class Comment extends Model
{
    //


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function recipe(){
        return $this->belongsTo(Recipe::class);
    }
}
