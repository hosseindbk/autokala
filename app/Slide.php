<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    public function stateslide()
    {
        return $this->belongsToMany(State::class);
    }
}
