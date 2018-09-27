<?php
/**
 * Created by PhpStorm.
 * User: abdallah
 * Date: 27/09/18
 * Time: 10:20 ص
 */

if (!function_exists('category_count')) {
    function category_count($cat_id)
    {
        $count = \App\Models\Post::published()
            ->whereHas('categories', function ($query) use ($cat_id) {
                $query->where('id', $cat_id);
            })->count();
        return $count;
    }
}

if(!function_exists('nav_url')){
    function nav_url($nav){
        switch ($nav->type) {
            case "url":
                return route('index')."/".$nav->link;
            case 'page':
                return \App\Models\Page::find($nav->type_id)->path;
        }
        return route('index')."/".$nav->link;
    }
}
