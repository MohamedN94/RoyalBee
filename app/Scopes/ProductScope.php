<?php

namespace App\Scopes ;

use Illuminate\Database\Eloquent\Scope;

class ProductScope extends SearchScope
{
    protected $columns = ['name_ar','name_en'];
}
