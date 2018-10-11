<?php

namespace Dot\Galleries\Controllers;

use Dot\Galleries\Models\Gallery;
use Dot\Platform\APIController;
use Illuminate\Http\Request;

/*
 * Class GalleriesApiController
 */
class GalleriesApiController extends APIController
{

    /*
     * GalleriesApiController constructor.
     */
    function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware("permission:galleries.manage");
    }

    /*
     * List galleries
     * @param int $id (optional) The object identifier.
     * @param string $lang (default: user locale) The lang code.
     * @param string $q (optional) The search query string.
     * @param array $with (optional) extra related gallery components [user, files].
     * @param int $limit (default: 10) The number of retrieved records.
     * @param int $page (default: 1) The page number.
     * @param string $order_by (default: id) The column you wish to sort by.
     * @param string $order_direction (default: DESC) The sort direction ASC or DESC.
     * @return \Illuminate\Http\JsonResponse
     */
    function show(Request $request)
    {

        $id = $request->get("id");
        $limit = $request->get("limit", 10);
        $sort_by = $request->get("order_by", "id");
        $sort_direction = $request->get("order_direction", "DESC");

        $components = $request->get("with", []);

        foreach ($components as $relation => $data) {
            $components[$relation] = function ($query) use ($data) {
                return $query->orderBy(array_get($data, 'order_by', "id"), array_get($data, 'order_direction', "DESC"));
            };
        }

        $query = Gallery::with($components)->orderBy($sort_by, $sort_direction);

        if ($request->filled("q")) {
            $query->search($request->get("q"));
        }

        if ($id) {
            $galleries = $query->where("id", $id)->first();
        } else {
            $galleries = $query->paginate($limit)->appends($request->all());
        }

        return $this->response($galleries);

    }


    /*
     * Create a new gallery
     * @param string $name (required) The gallery name.
     * @param string $slug (optional) The gallery slug.
     * @param string $author (optional) The gallery author name.
     * @param string $lang (default: user locale) The gallery lang.
     * @param array $file_ids (optional) The list of files ids.
     * @return \Illuminate\Http\JsonResponse
     */
    function create(Request $request)
    {

        $gallery = new Gallery();

        $gallery->name = $request->name;
        $gallery->slug = $request->slug;
        $gallery->author = $request->author;
        $gallery->user_id = $this->user->id;
        $gallery->lang = app()->getLocale();

        // Validate and save requested user
        if (!$gallery->validate()) {

            // return validation error
            return $this->response($gallery->errors(), "validation error");

        }

        if ($gallery->save()) {

            $files = $request->get("file_ids", []);
            $gallery->files()->sync($files);

            return $this->response($gallery);
        }

    }

    /*
     * Update gallery by id
     * @param int $id (required) The gallery id.
     * @param string $name (required) The gallery name.
     * @param string $slug (optional) The gallery slug.
     * @param string $author (optional) The gallery author name.
     * @param array $file_ids (optional) The list of files ids.
     * @return \Illuminate\Http\JsonResponse
     */
    function update(Request $request)
    {

        if (!$request->id) {
            return $this->error("Missing tag id");
        }

        $gallery = Gallery::find($request->id);

        if (!$gallery) {
            return $this->error("Post #" . $request->id . " is not exists");
        }

        $gallery->name = $request->get('name', $gallery->name);
        $gallery->slug = $request->get('slug', $gallery->slug);
        $gallery->author = $request->get("author", $gallery->author);
        $gallery->user_id = $this->user->id;

        if ($gallery->save()) {

            $files = $request->get("file_ids", []);
            $gallery->files()->sync($files);

            return $this->response($gallery);
        }

    }

    /*
     * Delete gallery by id
     * @param int $id (required) The gallery id.
     * @return \Illuminate\Http\JsonResponse
     */
    function destroy(Request $request)
    {

        if (!$request->id) {
            return $this->error("Missing tag id");
        }

        $gallery = Gallery::find($request->id);

        if (!$gallery) {
            return $this->error("Gallery #" . $request->id . " is not exists");
        }

        // Destroy requested post
        $gallery->delete();

        return $this->response($gallery);

    }


}
