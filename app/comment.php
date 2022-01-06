<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $fillable = ['comment' , 'approved' , 'parent_id' , 'commentable_id'  ,'phone', 'commentable_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function child(){
        return $this->hasMany(comment::class , 'parent_id' , 'id');
    }

}
