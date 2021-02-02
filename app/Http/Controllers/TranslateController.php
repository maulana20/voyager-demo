<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Category;

class TranslateController extends Controller
{
    public function tags($lang)
    {
        $tags = Tag::all()->translate($lang);
        
        return response()->json($tags);
    }
    
    public function categories($lang)
    {
        $categories = Category::all()->translate($lang);
        
        return response()->json($categories);
    }
}
