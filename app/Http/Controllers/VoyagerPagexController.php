<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Page;
use App\Tag;

class VoyagerPagexController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function store(Request $request)
    {
        $request->validate((New Page)->getRules($request));
        
        $page = Page::create((New Page)->getData($request));
        
        if (!empty($request->tag)) $page->tags()->sync((array) $request->tag);
        
        return redirect()->route('voyager.pages.index')->with($this->alertSuccess('Successfully Saved Page'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate((New Page)->getRules($request));
        
        $page = Page::find($id);
        
        $page->update((New Page)->getData($request));
        
        if (!empty($request->tag)) $page->tags()->sync((array) $request->tag);
        
        return redirect()->route('voyager.pages.index')->with($this->alertSuccess('Successfully Updated Page'));
    }
}
