<?php

namespace App\Http\Middleware;

use App\Events\userActivity;
use App\Models\Audit\AuditUser;
use App\Models\Chapter;
use App\Models\Comic\Comic;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class AuditUserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $title = '';
        if(Route::currentRouteName() == 'comic.show'){
            $slug = trim(str_replace(URL::to('/comic'), '', url()->current()),'/');
            $title = ($slug ?? 0) ? Comic::select('title')->where('slug', $slug)->first()->title : '';
        }

        if(Route::currentRouteName() == 'comic.chapter'){
            $slug = str_replace('baca-', '', trim(str_replace(URL::to('/comic'), '', url()->current()),'/'));
            
            $query = Chapter::select('comic_id','episode')
                            ->with(['comic' => function ($q) {
                                $q->select('id','title');
                            }])->where('slug',$slug)->first();
                            
            if($query){
                $title = $query->comic->title;
                $chapter = $query->episode;
            }
        }
        
        $config = [
            'index' => ['msg' => 'Home Page', 'tags' => 'Page'],
            'genre'  => ['msg' => 'Membuka Halaman genre List', 'tags' => 'Genre'],
            'search'  => ['msg' => 'Membuka Halaman genre List', 'tags' => 'Search'],
            'dmca' => ['msg' => 'Membuka Halaman DMCA', 'tags' => 'Page'],
            'contact' => ['msg' => 'Membuka Halaman Contact', 'tags' => 'Page'],
            'privacy-policy' => ['msg' => 'Membuka Halaman Privacy Policy', 'tags' => 'Page'],
            'update' => ['msg' => 'Membuka Halaman Update', 'tags' => 'Page'],
            'comic.index' => ['msg' => 'Comic List', 'tags' => 'Page'],
            'comic.filter' => ['msg' => 'Comic Filter Mode', 'tags' => 'Page'],
            'comic.comment' => ['msg' => 'Comic Comment', 'tags' => 'Comment'],
            'comic.list' => ['msg' => 'Comic List Mode', 'tags' => 'Page'],
            'comic.show' => ['msg' => 'Comic : '.$title, 'tags' => 'Comic'],
            'comic.genre' => ['msg' => 'Category', 'tags' => 'Page'],
            'comic.chapter' => ['msg' => 'Comic : '.($title ?? '?').' || Chapter : '.($chapter ?? '?'), 'tags' => 'Chapter'],
        ];

        $audit = AuditUser::create([
            'url'           => url()->current(),
            'tags'          => $config[Route::currentRouteName()]['tags'],
            'msg'           => $config[Route::currentRouteName()]['msg'],
            'ip_address'    => \Request::ip(),
            // 'user_agent'    => \Request::userAgent(),
            'user_agent'    => ''
        ]);

        if($audit) {
            userActivity::dispatch($audit);
            return $next($request);
        }
    }
}