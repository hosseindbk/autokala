<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function scopeBrandSearch($query , $keywords)
    {
        $category = request('category_id');
        if ($category == 'all' || $category == null)
        {
            $query->where('title_fa' , 'LIKE' , '%' .$keywords. '%')
                ->orwhere('title_en' , 'LIKE' , '%' .$keywords. '%')
                ->orwhere('abstract_title' , 'LIKE' , '%' .$keywords. '%');
        }else {
            $query->where($category, 'LIKE', '%' . $keywords . '%');
        }
        return $query;
    }

    public function scopeFilter($query)
    {

        $country_id = request('country_id');
        if (isset($country_id) && $country_id != '') {
            $query->whereIn('country_id' , $country_id);
        }
    }

    public  function comment(){

        return $this->morphMany(comment::class, 'commentable');
    }
}
