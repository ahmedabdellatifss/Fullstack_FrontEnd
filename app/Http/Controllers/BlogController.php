<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Category;
use App\Blog;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::select('id','categoryName')->get();
        $blogs= Blog::orderBy('id' , 'desc')->with(['cat' , 'user'])->limit(6)->get(['id', 'title' , 'post_excerpt','slug','user_id' , 'featuredImage']);

        return view('home')->with([ 'category'=>$categories , 'blog'=>$blogs ]);
    }

    public function blogSingle(Request $request , $slug)
    {

        $blogs= Blog::where('slug', $slug)->with(['cat' ,'tag' , 'user'])->first(['id', 'title','user_id' , 'featuredImage' , 'post']);
        $category_ids=[];
        foreach($blogs->cat as $cat){
            array_push($category_ids , $cat->id);
        }

        // Get related artical With larvel whereHas filtering

        $relatedBlogs = Blog::with('user')->where('id', '!=' , $blogs->id)->whereHas('cat' ,function ($q) use($category_ids){ //#52
            $q->whereIn('category_id' , $category_ids);
        })->limit(5)->orderBy('id' , 'desc')->get(['id' , 'title' ,'slug','user_id' , 'featuredImage']);

        return view('blogsingle')->with(['blog'=>$blogs , 'relatedBlogs'=>$relatedBlogs]);
    }

        // #51
    public function compose(View $view)
    {
        $cat = Category::select('id','categoryName')->get('id' , 'categoryName');
        $view->with('cat', $cat);
    }



    public function categoryIndex(Request $request , $categoryName , $id){
         $blogs = Blog::with('user')->whereHas('cat' ,function ($q) use($id){ //#53
            $q->where('category_id' , $id);
        })->orderBy('id' , 'desc')->select(['id' , 'title' ,'slug','user_id' , 'featuredImage'])->paginate(1);
        return view('category')->with(['categoryName' => $categoryName , 'blogs' =>$blogs]);
    }

    public function tagIndex(Request $request , $tagName , $id){
        $blogs = Blog::with('user')->whereHas('tag' ,function ($q) use($id){ //#53
            $q->where('tag_id' , $id);
        })->orderBy('id' , 'desc')->select(['id' , 'title' ,'slug','user_id' , 'featuredImage'])->paginate(1);
        return view('tag')->with(['tagName'=>$tagName , 'blogs'=>$blogs]);
    }

    public function allBlogs()
    {
        $blogs= Blog::orderBy('id' , 'desc')->with(['cat' , 'user'])->select(['id', 'title' , 'post_excerpt','slug','user_id' , 'featuredImage'])->paginate(1);
        return view('blogs')->with(['blog'=>$blogs ]);
    }

    public function search(Request $request)
    {
        $str = $request->str;
        $blogs= Blog::orderBy('id' , 'desc')->with(['cat' , 'user'])->select(['id', 'title' , 'post_excerpt','slug','user_id' , 'featuredImage']);
        // use eloquent when instead of if to make code more readable
        $blogs->when($str!='' , function($q) use($str){
            $q->where('title' , 'LIKE' , "%{$str}%")
            ->orWhereHas('cat' , function($q) use($str){
                $q->where('categoryName' , $str);
            })
            ->orWhereHas('tag' , function($q) use($str){
                $q->where('tagName' , $str);
            });

        });
        $blogs = $blogs->paginate(1);
        $blogs = $blogs->appends($request->all());
        return view('blogs')->with(['blog'=>$blogs ]);



        // if(!$str) return $blogs->get();
        //     $blogs->where('title' , 'LIKE' , "%{$str}%")
        //         ->orWhereHas('cat' , function($q) use($str){
        //             $q->where('categoryName' , $str);
        //         })
        //         ->orWhereHas('tag' , function($q) use($str){
        //             $q->where('tagName' , $str);
        //         });
        // return $blogs->get();
    }
}
