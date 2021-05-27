<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Page;
use App\Post;
use App\Tag;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (!empty($request->get('tag'))) {
            $tag = Tag::where('name', $request->get('tag'))->firstOrFail();
            
            $posts = Tag::with('posts')->find($tag->id)->posts()->latest()->get();
            $pages = Tag::with('pages')->find($tag->id)->pages()->latest()->get();
        } else {
            $posts = Post::latest()->get();
            $pages = Page::latest()->get();
        }
        
        $lang = empty($request->get('lang')) ? 'id' : $request->get('lang');
        App::setlocale($lang);
        
        return view('home.index', compact('posts', 'pages', 'lang'));
    }
}
