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
        view()->composer('layouts.partials.footer', function ($view) {
            $cats = Category::with('posts')->get();
            foreach ($cats as $key => $cat){
                $cats[$key]['count'] = category_count($cat->id);
            }
            $view->with('cats', $cats);

            ($nav = Nav::with('items')->where(['menu' => "15"])->get());

            $view->with('footerNav', $nav);
        });

        view()->composer('layouts.partials.header', function ($view) {
            ($nav = Nav::with('items')->where(['menu' => "1"])->get());

            $view->with('headerNav', $nav);
        });

        require app_path('./helper.php');
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
