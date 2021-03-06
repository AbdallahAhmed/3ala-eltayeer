<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public $data = array();

    /**
     * GET /pages/{slug}
     * @route pages.show
     * @param Request $request
     * @param $slug
     * @return mixed
     * @throws \Throwable
     */
    public function show(Request $request, $slug){
        $this->data['page'] = Page::where('slug', $slug)->firstorfail();
        return view('page-details', $this->data);
    }
}
