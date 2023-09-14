<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Comic\Comic;
use App\Models\Comic\ComicPopular;
use App\Models\Comic\ComicTrending;
use App\Models\ComicDetail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        $populars       = $this->popular();
        $genres_filter = Category::select('id','title','slug')->withCount('comics')->orderBy('title','ASC')->get();
        $genres         = $genres_filter->where('comics_count', '>=', 20)->all();
        $latests        = Comic::select('id','slug','title','updated_at')
                            ->with(['chapters' => function ($query) {
                                        $query->select('comic_id');
                                    }],['detail' => function ($query) {
                                        $query->select('comic_id');
                                    }])
                            ->wherehas('chapters')
                            ->orderBy('updated_at', 'DESC')
                            ->simplePaginate(18);

        $projects       = Comic::select('id','slug','title','updated_at')
                            ->with(['chapters' => function ($query) {
                                $query->select('comic_id');
                            }],['detail' => function ($query) {
                                $query->select('comic_id');
                            }])
                            ->wherehas('detail', function($query){
                                $query->where('project', 1);
                            })
                            ->orderBy('updated_at', 'DESC')
                            ->limit(9)
                            ->get();
                        
        return view('frontend.index',compact('projects','latests','genres','populars'));
    }

    public function categories(){
        $categories = Category::orderBy('title', 'ASC')->get();
        return $categories;
    }

    public function popular(){
        return ComicPopular::select('comic_id')
                            ->with(['comic' => function($query) {
                                $query->select('id','slug','title');
                            }])
                            ->orderBy('order', 'ASC')
                            ->limit(15)
                            ->get();
    }

    public function genre($genre){
        $populars   =  $this->popular();
        $category = Category::where('slug',$genre)->first();
        $comics = $category->comics()->paginate(20);
        $genres     = Category::orderBy('title','ASC')->get();
        $sideNews   = Comic::with('detail')->limit(5)->orderBy('created_at', 'DESC')->get();
        
        return view('frontend.genre', compact('genres', 'comics','sideNews','category','populars'));
        
    }

    public function search(Request $request){
        $search = $request->search;

        $title = "Hasil Pencarian  ".ucfirst($search);
        $comics = Comic::with('detail')->where('title', 'LIKE', '%'.$search.'%')->orderBy('updated_at', 'DESC')->paginate(20);

        $categories = $this->categories();
        return view('frontend.other', compact('title', 'comics', 'categories','search'));
    }

    public function update(){
        $sideNews   = Comic::with('detail')->limit(5)->orderBy('created_at', 'DESC')->get();
        $comics     = Comic::with('detail','chapters')->orderBy('title', 'ASC')->simplePaginate(20);
        $categories = Category::orderBy('title', 'ASC')->get();
        $genres     = Category::orderBy('title','ASC')->get();

        return view('frontend.comic', compact('comics','sideNews','categories','genres'));
    }

    public function dmca(){
        $sideNews   = Comic::with('detail')->limit(5)->orderBy('created_at', 'DESC')->get();
        $genres     = Category::orderBy('title','ASC')->get();

        return view('frontend.dmca',compact('sideNews','genres'));
    }

    public function contact(){
        $sideNews   = Comic::with('detail')->limit(5)->orderBy('created_at', 'DESC')->get();
        $genres     = Category::orderBy('title','ASC')->get();

        return view('frontend.contact',compact('sideNews','genres'));
    }

    public function privacyPolicy(){
        $sideNews   = Comic::with('detail')->limit(5)->orderBy('created_at', 'DESC')->get();
        $genres     = Category::orderBy('title','ASC')->get();

        return view('frontend.privacypolicy',compact('sideNews','genres'));
    }
}