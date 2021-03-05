<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Post;
use App\Tag;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    
    public function page(Request $request)
    {
        if (!empty($request->get('tag'))) {
            $pages = Tag::with('pages')->find($request->get('tag'))->pages()->paginate(10);
        } else {
            $pages = Page::paginate(10);
        }
        
        $lang = empty($request->get('lang')) ? 'id' : $request->get('lang');
        
        return view('demo.page', compact('pages', 'lang'));
    }
    
    public function post(Request $request)
    {
        if (!empty($request->get('tag'))) {
            $posts = Tag::with('posts')->find($request->get('tag'))->posts()->paginate(10);
        } else {
            $posts = Post::paginate(10);
        }
        
        $lang = empty($request->get('lang')) ? 'id' : $request->get('lang');
        
        return view('demo.post', compact('posts', 'lang'));
    }
}
