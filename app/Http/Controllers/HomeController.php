<?php

namespace App\Http\Controllers;

use App\Mail\SubscribeMail;
use App\Models\Category;
use App\Models\Post;
use Dot\Platform\Classes\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public $data = array();

    /**
     * GET /
     * @route index
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
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


    /**
     * GET /search/{q?}
     * @route search
     * @param Request $request
     * @param $q
     * @return mixed
     * @throws \Throwable
     */
    public function search(Request $request, $q = '')
    {
        $offset = $request->get('offset', 0);
        $limit = $request->get('limit', 3);
        $q = trim(urldecode($q));
        $this->data['q'] = $q;
        $this->data['videos'] = Post::published()
            ->where([
                ['format', 'video'],
                ['title', 'like', '%' . $q . '%']
            ])->orWhereHas('categories', function($query) use($q){
                $query->where('name', 'like', '%' . $q . '%');
            })
            ->offset($offset)
            ->limit($limit)
            ->orderBy('published_at', 'DESC')
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
            'email.required' => trans('app.subscribe.required'),
            'email.email' => trans('app.subscribe.validation'),
            'email.unique' => trans('app.subscribe.unique')
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
        Mail::to($request->get('email'))->send(new SubscribeMail($request->get('email')));
        return response()->json(['status' => true]);
    }
}
