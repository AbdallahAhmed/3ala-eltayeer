<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $data = array();

    public function index(Request $request){

        $offset = $request->get('offset', 0);
        $limit = $request->get('limit', 12);

        $this->data['videos'] = Post::where('format', 'video')
            ->published()
            ->offset($offset)
            ->limit($limit)
            ->get();

        if ($request->ajax()) {
            return response()->json([
                'videos' => $this->data['videos'],
                'count' => count($this->data['videos']),
                'view' => view('extensions.index-videos', ['videos' => $this->data['videos']])->render()
            ]);
        }
        return view('index', $this->data);
    }

    public function show(Request $request, $slug){

    }
}
