<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public $data = array();
    public function show(Request $request, $slug){
        $this->data['page'] = Page::where('slug', $slug)->firstorfail();
        return view('page-details', $this->data);
    }
}
