<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $data = array();
    public function index(Request $request, $slug){

        return view('category', $this->data);
    }
}
