<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Page;
use App\Tag;

class VoyagerPagesController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'excerpt' => 'required',
                'body' => 'required',
                'slug' => 'required|unique:pages,slug',
                'meta_description' => 'required',
                'meta_keywords' => 'required',
                'status' => 'in:ACTIVE,INACTIVE',
            ]
        );
        
        if ($request->hasfile('image')) $this->validate($request, [ 'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', ]);
        
        $data = [
            'author_id' => Auth::user()->id,
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'slug' => $request->slug,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'status' => $request->status
        ];
        
        if ($request->hasfile('image')) $data['image'] = $request->image;
        
        try {
            $page = Page::create($data);
            if (!empty($request->tag_id)) $page->tags()->save(Tag::find(1));
        } catch (Exception $e) {
            return redirect()->route('voyager.pages.index')->with($this->alertError($e->getMessage()));
        }
        
        return redirect()->route('voyager.pages.index')->with($this->alertSuccess('Successfully Saved Page'));
    }
    
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'excerpt' => 'required',
                'body' => 'required',
                'slug' => 'required',
                'meta_description' => 'required',
                'meta_keywords' => 'required',
                'status' => 'in:ACTIVE,INACTIVE',
            ]
        );
        
        if ($request->hasfile('image')) $this->validate($request, [ 'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', ]);
        
        $page = Page::find($id);
        
        $page->author_id = Auth::user()->id;
        $page->title = $request->title;
        $page->excerpt = $request->excerpt;
        $page->body = $request->body;
        $page->slug = $request->slug;
        $page->meta_description = $request->meta_description;
        $page->meta_keywords = $request->meta_keywords;
        $page->status = $request->status;
        
        if ($request->hasfile('image')) $page->image = $request->image;
        
        try {
            $page->save();
            if (!empty($request->tag_id)) {
                // $page->tags()->detach();
                $page->tags()->sync([$request->tag_id]);
            }
        } catch (Exception $e) {
            return redirect()->route('voyager.pages.index')->with($this->alertError($e->getMessage()));
        }
        
        return redirect()->route('voyager.pages.index')->with($this->alertSuccess('Successfully Updated Page'));
    }
}
