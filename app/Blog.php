<?php

namespace App;
use App\Tag;
use App\Category;
use App\User;


use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title', 'post', 'post_excerpt', 'slug', 'user_id', 'featuredImage', 'metaDescription', 'views', 'jsonData'];

    public function setSlugAttribute($title){
        $this->attributes['title'] = $this->uniqueSlug($title);
    }

    private function uniqueSlug($title){
        $slug = Str::slug($title, '-');
        $count = Blog::where('slug', 'LIKE', "{$slug}%")->count();
        $newCount = $count > 0 ? ++$count : '';
        return $newCount > 0 ? "$slug-$newCount" : $slug;
    }

    public function tag()
    {
        return $this->belongsToMany('App\Tag', 'blogtags');
    }
    public function cat()
    {
        return $this->belongsToMany('App\Category', 'blogcategories');
    }
    public function user()
    {
        return $this->belongsTo('App\User')->select('id' , 'fullName' );
    }


}

