<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;

class Post extends Model
{
    use Translatable;
    use Resizable;
    
    protected $translatable = ['title', 'seo_title', 'excerpt', 'body', 'slug', 'meta_description', 'meta_keywords'];
    
    const PUBLISHED = 'PUBLISHED';
    
    protected $guarded = [];
    
    protected $appends = ['full_image'];
    
    public function save(array $options = [])
    {
        if (!$this->author_id && \Auth::user()) {
            $this->author_id = \Auth::user()->getKey();
        }
        
        return parent::save();
    }
    
    public function authorId()
    {
        return $this->belongsTo(Voyager::modelClass('User'), 'author_id', 'id');
    }
    
    public function scopePublished(Builder $query)
    {
        return $query->where('status', '=', static::PUBLISHED);
    }
    
    public function category()
    {
        return $this->belongsTo(Voyager::modelClass('Category'));
    }
    
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
    
    public function getFullImageAttribute()
    {
        return url('storage/' . $this->image);
    }
}

