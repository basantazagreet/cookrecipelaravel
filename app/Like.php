<?php

namespace App;
use App\Recipe;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //

    public function recipe(){
        return $this->belongsTo(Recipe::class);
    }
}
