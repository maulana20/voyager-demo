<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['author_id', 'title', 'excerpt', 'body', 'slug', 'meta_description', 'meta_keywords', 'status'];
    
    public $timestamps = true;
    
    public function getRules($request)
    {
        $rules = [
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'slug' => 'required|unique:pages,slug,' . $request->id,
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'status' => 'in:ACTIVE,INACTIVE',
        ];
        
        if ($request->hasfile('image')) $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        
        return $rules;
    }
    
    public function getData($request)
    {
        $data = [
            'author_id' => \Auth::user()->id,
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'slug' => $request->slug,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'status' => $request->status
        ];
        
        if ($request->hasfile('image')) $data['image'] = $request->image;
        
        return $data;
    }
    
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
