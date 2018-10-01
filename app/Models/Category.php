<?php

namespace App\Models;

use Dot\Categories\Models\Category as Model;

class Category extends Model
{
    public function getPathAttribute()
    {
        return route('category',['slug'=>$this->slug]);
    }

    /**
     * posts relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Category::class, "posts_categories", "category_id", "post_id");
    }

}
