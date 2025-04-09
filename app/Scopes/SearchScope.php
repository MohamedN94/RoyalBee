<?php

namespace App\Scopes ;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SearchScope implements Scope 
{
    protected $columns =[] ;
    public function apply(Builder $builder, Model $model)
    {
        if($search = request('search')){
            foreach( $this->columns as $column){
                $array = explode('.', $column);
                if( count($array) == 2 ){
                    list($relation , $col) = $array ;
                    $builder->orWhereHas($relation , function($query) use($col ,$search){
                        $query->where($col , 'LIKE' , "%{$search}%") ;
                    });
                }else{
                    $builder->orWhere($column , 'LIKE' , "%{$search}%");
                };
            }
        }
    }
}
