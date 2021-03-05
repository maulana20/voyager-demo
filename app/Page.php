<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Traits\Translatable;

class Page extends Model
{
    use Translatable;
    
    protected $translatable = ['title', 'slug', 'body'];
    
    protected $appends = ['full_image', 'tags_name'];
    
    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_INACTIVE = 'INACTIVE';
    
    public static $statuses = [self::STATUS_ACTIVE, self::STATUS_INACTIVE];

    protected $guarded = [];

    public function save(array $options = [])
    {
        if (!$this->author_id && \Auth::user()) {
            $this->author_id = \Auth::user()->getKey();
        }
        
        return parent::save();
    }
    
    public function scopeActive($query)
    {
        return $query->where('status', static::STATUS_ACTIVE);
    }
    
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
    
    public function getFullImageAttribute()
    {
        return url('storage/' . $this->image);
    }
    
    public function getTagsNameAttribute()
    {
        if (empty($this->tags)) return null;
        
        $tags = array_map(function($tag) { return $tag['name']; }, $this->tags()->get()->toArray());
        
        return implode(',', $tags);
    }
}
