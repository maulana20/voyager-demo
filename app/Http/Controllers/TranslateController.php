<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TranslateController extends Controller
{
    public function tags($lang)
    {
        $tags = Tag::all()->translate($lang);
        
        return response()->json($tags);
    }
}
