<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class commentrate extends Model
{
    protected $fillable = ['comment'
        ,'approved'
        ,'quality'
        ,'value'
        ,'innovation'
        ,'ability'
        ,'design'
        ,'comfort'
        ,'commentable_id'
        ,'name'
        ,'phone'
        ,'commentable_type'];

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
