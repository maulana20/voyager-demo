<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];
    
    public function pages()
    {
        return $this->morphedByMany(Page::class, 'taggable');
    }
    
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }
    
    public static function saveData($model, $tags)
    {
        if (empty($tags)) return false;
        
        $tag_list = [];
        foreach ($tags as $name) {
            $tag = Tag::firstOrCreate([ 'name' => $name ]);
            array_push($tag_list, $tag->id);
        }
        
        $model->tags()->sync((array) $tag_list);
    }
}
