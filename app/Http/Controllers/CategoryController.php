<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $data = array();

    public function index(Request $request, $slug)
    {
        $offset = $request->get('offset', 0);
        $limit = $request->get('limit', 12);

        $this->data['category'] = Category::where('slug', '=' , $slug)->first();
        $cat_id = $this->data['category']->id;
        $this->data['videos'] = Post::where('format', 'video')
            ->published()
            ->whereHas('categories', function ($query) use ($cat_id) {
                $query->where('id', $cat_id);
            })
            ->take($limit)
            ->offset($offset)
            ->get();
        $this->data['count'] = count($this->data['videos']);
        if($request->ajax()){
            return response()->json([
                'videos' => $this->data['videos'],
                'count' => $this->data['count'],
                'view' => view('extensions.index-videos', ['videos' => $this->data['videos']])->render()
            ]);
        }
        return view('category', $this->data);
    }
}
