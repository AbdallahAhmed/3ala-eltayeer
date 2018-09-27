<?php

namespace App\Models;

use Dot\Posts\Models\Post as Model;
use Illuminate\Support\Carbon;

class Post extends Model
{
    /**
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->status('published')->where('published_at', '<=', Carbon::now());
    }

    /**
     * Path Attribute
     * @return string
     */
    public function getPathAttribute()
    {
        return route('posts.show', ['slug' => $this->slug, 'lang' => app()->getLocale()]);
    }

    public function getCategoryAttribute(){
        return $this->categories()->first();
    }


}
