<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Comic\Comic;
use App\Models\Comic\ComicPopular;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class ComicController extends Controller
{
    public function index(){
        
        $populars   =  ComicPopular::select('comic_id')
                                ->with(['comic' => function($query) {
                                    $query->select('id','slug','title');
                                }])
                                ->orderBy('order', 'ASC')
                                ->limit(15)
                                ->get();
        
        $chars = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        $sideNews   = Comic::with('detail')->limit(5)->orderBy('created_at', 'DESC')->get();
        $categories = Category::orderBy('title', 'ASC')->get();
        $genres     = Category::orderBy('title','ASC')->get();
        
        return view('frontend.comic', compact('sideNews','categories','genres','chars','populars'));
    }

    public function filter(Request $request){
        $result = [];
        
        $chars = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        foreach ($chars as $char) {
            // $query = Comic::
            $query = Comic::with(['detail','categories'])->where('title', 'LIKE', $char.'%');
            if($request->genre && $request->genre != '#'){
                $genre = $request->genre;
                $query->whereHas('categories', function($q) use ($genre){
                    $q->where('id', $genre);
                });
            }

            if($request->type && $request->type != 'all'){
                $type = $request->type;
                $query->whereHas('detail', function($q) use ($type){
                    if($type == 'end'){
                        $q->where('status', 'Completed');
                    }elseif($type == 'project'){
                        $q->where('project',1);
                    }else{
                        $q->where('status','Ongoing');
                    }
                });
            }

            // if($request->genre == '#' && $request->type ==)
         
            $comics[] = $query->get();
            
        }

        if($request->genre == '#' && $request->type == 'all'){
            $key = 'articles';
            $param = [
                'test1' => $chars,
                'test2' => $comics
            ];

            if (!Cache::has($key)) {
                Cache::rememberForever($key, function () use ($param){
                    return view('frontend.filter',[
                                    'chars' => $param['test1'],
                                    'comics'=> $param['test2']
                                ])->render();
                });
            }
            
            $view = Cache::get($key);
        }else{
            $view = view('frontend.filter',compact('chars', 'comics'))->render();
        }
        
        return response()->json($view, 200);
    }

    public function list(){
        $page_title = "Daftar Komik";
        $days           = ComicPopular::with('comic')->where('day',1)->orderBy('order', 'ASC')->limit(7)->get();
        $weeks          = ComicPopular::with('comic')->where('week',1)->orderBy('order', 'ASC')->limit(5)->get();
        $months         = ComicPopular::with('comic')->where('month',1)->orderBy('order', 'ASC')->limit(5)->get();
        $alls           = ComicPopular::with('comic')->where('all',1)->orderBy('order', 'ASC')->limit(5)->get();
        $sideNews       = Comic::with('detail')->limit(5)->orderBy('created_at', 'DESC')->get();
        $genres         = Category::orderBy('title','ASC')->get();

        // $web_description = "Daftar Komik terlengkap yang tersedia di ".Helper::title().", semua berbahasa Indonesia dengan kualitas gambar HD.";

        $chars = array('#','A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        foreach ($chars as $char) {
            if($char == '#'){
                $uniques = array('.',']','1','2','3','4','5','6','7','8','9','0');
                foreach ($uniques as $unique) {
                    $comics[] = Comic::with('detail')->where('title', 'LIKE', $unique.'%')->get();
                }
            }else{
                $comics[] = Comic::with('detail')->where('title', 'LIKE', $char.'%')->get();
            }
        }

        return view('frontend.list', compact('days','weeks','months','alls','page_title','chars','comics','sideNews','genres'));
    }

    public function show($slug){
        $comic      = Comic::where('slug', $slug)->firstOrFail();
        $populars   =  ComicPopular::select('comic_id')
                                ->with(['comic' => function($query) {
                                    $query->select('id','slug','title');
                                }])
                                ->orderBy('order', 'ASC')
                                ->limit(15)
                                ->get();
        $cat        = $comic->categories->first();
        $relations  = Comic::limit(0)->get();
        if($cat){
            $relations  = Comic::whereHas('categories', function($q) use ($cat){
                $q->where('id',$cat->id);
            })->limit(5)->get();
        }
        $genres         = Category::orderBy('title','ASC')->get();
        $description    = substr('Baca komik '.$comic->title.' bahasa Indonesia lengkap di '.env('APP_NAME').'. '.($comic->detail ? ($comic->detail->type ? $comic->detail->type : 'Manga') : 'Manga').' '.$comic->title.' bercerita tentang '.($comic->detail ? ($comic->detail->description ? $comic->detail->description : $comic->title) : $comic->title),0,250);
        
        return view('frontend.detail_comic', compact('comic','relations','genres','description','populars'));
    }

    public function chapter($slug){
        $populars   =  ComicPopular::select('comic_id')
                                ->with(['comic' => function($query) {
                                    $query->select('id','slug','title');
                                }])
                                ->orderBy('order', 'ASC')
                                ->limit(15)
                                ->get();
        $chapter    = Chapter::where('slug',$slug)->firstOrFail();
        $comic      = $chapter->comic;
        $cat        = $comic->categories->first();
        $next       = Chapter::where('comic_id',$chapter->comic->id)->where('order', $chapter->order + 1)->first();
        $prev       = Chapter::where('comic_id',$chapter->comic->id)->where('order', $chapter->order - 1)->first();
        $relations  = Comic::limit(0)->get();
        $comments   = Comment::where('comic_id',$comic->id)->where('chapter_id',$chapter->id)->where('parent_id',0)->where('status',1)->orderBy('id','DESC')->get();

        if($cat){
            $relations  = Comic::whereHas('categories', function($q) use ($cat){
                $q->where('id',$cat->id);
            })->limit(7)->get();
        }
        $description    = substr('Berikut link baca gratis dan download komik '.$comic->title.' '.$chapter->title.' bahasa Indonesia! Baca online '.$comic->title.' Ch.'.$chapter->episode.' di '.env('APP_NAME').'.',0,250);
        
        return view('frontend.detail_chapter', compact('chapter','next','prev','relations','description','comments','populars'));
    }

    public function comment(Request $request){
        $result = [];
        $result['status'] = 0;
        $data = $request->all();
        if(!$request->name) $data['name'] = "Anonymous";
        $data['status'] = 1;

        $comment = Comment::create($data);
        if($comment->id) $result['status'] = 1;

        return response()->json($result,200);
    }
}