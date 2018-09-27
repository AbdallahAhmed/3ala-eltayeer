<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $data = array();

    public function index(Request $request)
    {

        $offset = $request->get('offset', 0);
        $limit = $request->get('limit', 12);

        $this->data['videos'] = Post::where('format', 'video')
            ->published()
            ->offset($offset)
            ->limit($limit)
            ->orderBy('published_at', 'DESC')
            ->get();

        if ($request->ajax()) {
            return response()->json([
                'videos' => $this->data['videos'],
                'count' => count($this->data['videos']),
                'view' => view('extensions.index-videos', ['videos' => $this->data['videos']])->render()
            ]);
        }
        $this->data['categories'] = Category::with('posts')->where('lang', app()->getLocale())->get();

        return view('index', $this->data);
    }

    public function show(Request $request, $slug)
    {

        $offset = $request->get('offset', 0);
        $limit = $request->get('limit', 6);
        $this->data['video'] = Post::where('slug', $slug)->firstorfail();

        $this->data['videos'] = Post::where([
            ['format', 'video'],
            ['id', '<>', $this->data['video']->id]
        ])
            ->published()
            ->offset($offset)
            ->take($limit)
            ->orderBy('published_at', 'DESC')
            ->get();

        if ($request->ajax()) {
            return response()->json([
                'videos' => $this->data['videos'],
                'count' => count($this->data['videos']),
                'view' => view('extensions.video-details', ['videos' => $this->data['videos']])->render()
            ]);
        }
        $this->data['video'] = Post::where('slug', $slug)->firstorfail();
        $this->data['category'] = $this->data['video']->category;

        return view('video-details', $this->data);
    }
}
