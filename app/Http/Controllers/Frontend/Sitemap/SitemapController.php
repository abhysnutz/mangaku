<?php

namespace App\Http\Controllers\Frontend\Sitemap;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Comic\Comic;

class SitemapController extends Controller
{
    public $items = 500;

    public function index(){
        $comic = Comic::orderBy('created_at', 'DESC') ->first();
        $chapter = Chapter::orderBy('updated_at', 'DESC') ->first();
        $genre = Category::orderBy('updated_at', 'DESC') ->first();

        return response()->view('frontend.sitemap.sitemap', compact('comic','chapter','genre'))
                         ->header('Content-Type', 'text/xml');
    }

    public function home(){
        $chapter = Chapter::orderBy('updated_at', 'DESC')->first();

        return response()->view('frontend.sitemap.home', compact('chapter'))
                         ->header('Content-Type', 'text/xml');
    }


    public function comic(){
        $comicQuery = Comic::orderBy('updated_at', 'ASC');
        $comic = $comicQuery->first();
        $comicCount = $comicQuery->count();
                                            
        $loop = floor($comicCount / $this->items) + 1;
       
        return response()->view('frontend.sitemap.comic', compact('comic','loop'))
                         ->header('Content-Type', 'text/xml');
    }

    public function chapter(){
        $chapterQuery = Chapter::orderBy('updated_at', 'ASC');
        $chapter = $chapterQuery->first();
        $chapterCount = $chapterQuery->count();
                                            
        $loop = floor($chapterCount / $this->items) + 1;
       
        return response()->view('frontend.sitemap.chapter', compact('chapter','loop'))
                         ->header('Content-Type', 'text/xml');
    }

    public function comicDetail($page){
        $offset = ($page - 1 ) * $this->items;
        $limit = $this->items;
        
        $comics = Comic::orderBy('updated_at', 'ASC')
                            ->offset($offset)
                            ->limit($limit)
                            ->get();

        return response()->view('frontend.sitemap.comicDetail', compact('comics'))
                         ->header('Content-Type', 'text/xml');
    }

    public function chapterDetail($page){
        $offset = ($page - 1 ) * $this->items;
        $limit = $this->items;
        
        $chapters = Chapter::with('comic')->orderBy('chapters.updated_at', 'ASC')
                                                ->offset($offset)
                                                ->limit($limit)
                                                ->get();

        return response()->view('frontend.sitemap.chapterDetail', compact('chapters'))
                         ->header('Content-Type', 'text/xml');
    }

    public function genre(){
        $categories = Category::all();

        return response()->view('frontend.sitemap.genre', compact('categories'))
                         ->header('Content-Type', 'text/xml');
    }

    public function type(){
        return response()->view('frontend.sitemap.type')
                         ->header('Content-Type', 'text/xml');
    }
}
