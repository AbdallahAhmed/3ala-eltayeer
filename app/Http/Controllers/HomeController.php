<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Dot\Platform\Classes\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $this->data['categories'] = Category::with('posts')->get();

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
                'view' => view('extensions.index-videos', ['videos' => $this->data['videos']])->render()
            ]);
        }
        $this->data['video'] = Post::where('slug', $slug)->firstorfail();
        $this->data['category'] = $this->data['video']->category;

        return view('video-details', $this->data);
    }

    public function search(Request $request, $q)
    {
        $offset = $request->get('offset', 0);
        $limit = $request->get('limit', 3);
        $q = trim(urldecode($q));
        $this->data['q'] = $q;
        $this->data['videos'] = Post::published()
            ->where([
                ['format', 'video'],
                ['title', 'like', '%' . $q . '%']
            ])
            ->offset($offset)
            ->limit($limit)
            ->get();
        $this->data['count'] = count($this->data['videos']);

        if ($request->ajax()) {
            $this->data['view'] = view('extensions.search', ['videos' => $this->data['videos']])->render();
            $this->data['count'] = count($this->data['videos']);
            $this->data['status'] = true;
            return response()->json($this->data);
        }

        return view('search', $this->data);
    }

    /**
     * GET /subscribe
     * @route subscribe
     * @param Request $request
     * @return mixed
     */
    public function subscribe(Request $request)
    {
        $message = [
            'email.required' => trans('app.email_required'),
            'email.email' => trans('app.email_validation'),
            'email.unique' => trans('app.email_unique')
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletter_accounts',
        ], $message);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['status' => false, 'errors' => $errors]);
        }
        $now = Carbon::now();
        DB::table('newsletter_accounts')->insert(['email' => $request->get('email'), 'created_at' => $now, 'updated_at' => $now]);
        return response()->json(['status' => true]);
    }
}
