<?php

namespace App\Scopes ;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class Filter implements Scope {

    public function apply(Builder $builder , Model $model)
    {
        if($category = request('category')){
            $builder->where('name_ar' ,'LIKE' , "%{$category}%");
        }
    }

}
