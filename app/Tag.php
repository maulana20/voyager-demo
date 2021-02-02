<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Tag extends Model
{
    use Translatable;
    
    protected $translatable = ['name'];
    
    protected $fillable = ['name'];
}
