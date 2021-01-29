<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['name'];
    
    public $timestamps = true;
    
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
