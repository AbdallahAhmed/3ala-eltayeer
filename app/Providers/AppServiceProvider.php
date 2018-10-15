<?php

namespace App\Providers;

use App\Models\Category;
use Dot\Navigations\Models\Nav;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require app_path('./helper.php');
        $cats = Category::with('posts')->take(12)->get();
        foreach ($cats as $key => $cat){
            $cats[$key]['count'] = category_count($cat->id);
        }
        view()->composer('layouts.partials.footer', function ($view) use ($cats) {

            $view->with('cats', $cats);

            ($nav = Nav::with('items')->where(['menu' => "15"])->get());

            $view->with('footerNav', $nav);
        });

        view()->composer('layouts.partials.header', function ($view) use ($cats) {
            ($nav = Nav::with('items')->where(['menu' => "1"])->get());

            $view->with(['headerNav'=>$nav,'cats' =>$cats]);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
