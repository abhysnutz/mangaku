<?php

use App\Http\Controllers\Audit\AuditQueueController;
use App\Http\Controllers\Audit\AuditUserController;
use App\Http\Controllers\Backend\Comic\ChapterController;
use App\Http\Controllers\Backend\Comic\ComicController;
use App\Http\Controllers\Backend\Comic\PopularController;
use App\Http\Controllers\Backend\Comic\TrendingController;
use App\Http\Controllers\Backend\Grab\GrabController;
use App\Http\Controllers\Backend\Grabber\GrabberController;
use App\Http\Controllers\Frontend\ComicController as FEComic;
use App\Http\Controllers\Frontend\HomeController as FEHome;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\Queue\QueueController;
use App\Http\Controllers\Backend\Setting\PasswordController;
use App\Http\Controllers\Backend\Setting\SettingController;
use App\Http\Controllers\Frontend\Sitemap\SitemapController;
use Illuminate\Support\Facades\Route;


// SITEMAP
Route::get('sitemap.xml', [SitemapController::class, 'index']);
Route::group(['prefix' => 'sitemap', 'as' => 'sitemap.'], function(){
    Route::get('home', [SitemapController::class, 'home'])->name('home');
    Route::get('comic', [SitemapController::class, 'comic'])->name('comic');
    Route::get('comic/{page}', [SitemapController::class, 'comicDetail'])->name('comicDetail');
    Route::get('chapter', [SitemapController::class, 'chapter'])->name('chapter');
    Route::get('chapter/{page}', [SitemapController::class, 'chapterDetail'])->name('chapterDetail');
    Route::get('genre', [SitemapController::class, 'genre'])->name('genre');
});

// FRONTEND

Route::middleware('audit.user',)->group(function(){
    Route::get('/', [FEHome::class, 'index'])->name('index');
    Route::get('type/{type}', [FEHome::class, 'type'])->name('type');
    Route::get('other/{other}', [FEHome::class, 'other'])->name('other');
    Route::get('genre/{genre}', [FEHome::class, 'genre'])->name('genre');
    Route::get('search', [FEHome::class, 'search'])->name('search');
    Route::get('update', [FEHome::class, 'update'])->name('update');
    Route::get('dmca', [FEHome::class, 'dmca'])->name('dmca');
    Route::get('contact', [FEHome::class, 'contact'])->name('contact');
    Route::get('privacy-policy', [FEHome::class, 'privacyPolicy'])->name('privacy-policy');
    
    Route::namespace('Frontend')->group(function () {
        Route::group(["prefix" => "comic", "as" => "comic."], function(){
            Route::get('/', [FEComic::class, 'index'])->name('index');
            Route::get('list', [FEComic::class, 'list'])->name('list');
            Route::post('filter', [FEComic::class, 'filter'])->name('filter');
            Route::get('baca-{slug}', [FEComic::class, 'chapter'])->name('chapter');
            Route::get('{slug}', [FEComic::class, 'show'])->name('show');
            Route::post('comment', [FEComic::class, 'comment'])->name('comment');
        });
    });
});

// BACKEND
Route::namespace('Backend')->group(function () {
    Route::group(["prefix"=>"console", "as"=>'console.', 'middleware' => ['web','auth']], function(){

        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::get('index2', function(){
            return view('backend.index2');
        })->name('index');

        Route::group(["prefix"=>"pages"], function(){
            Route::get('{pages}', function($pages){ return view('backend.pages.'.$pages); })->name('pages'); 
            Route::get('ui/{ui}', function($ui){ return view('backend.pages.ui.'.$ui); })->name('pages.ui');
            Route::get('forms/{forms}', function($forms){ return view('backend.pages.forms.'.$forms); })->name('pages.forms');
            Route::get('tables/{tables}', function($tables){ return view('backend.pages.tables.'.$tables); })->name('pages.tables');
        });

        Route::group(['prefix' => 'comic', 'as' => 'comic.'], function(){
            Route::get('/', [ComicController::class, 'index'])->name('index');
            Route::post('list', [ComicController::class, 'list'])->name('list');
            Route::post('edit', [ComicController::class, 'edit'])->name('edit');
            Route::delete('destroy', [ComicController::class, 'destroy'])->name('destroy');
            Route::post('queue', [ComicController::class, 'queue'])->name('queue');
        });

        Route::group(['prefix' => 'trending', 'as' => 'trending.'], function(){
            Route::get('/', [TrendingController::class, 'index'])->name('index');
            Route::post('list', [TrendingController::class, 'list'])->name('list');
            Route::post('store', [TrendingController::class, 'store'])->name('store');
            Route::post('edit', [TrendingController::class, 'edit'])->name('edit');
            Route::post('update', [TrendingController::class, 'update'])->name('update');
            Route::delete('destroy', [TrendingController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'popular', 'as' => 'popular.'], function(){
            Route::get('/', [PopularController::class, 'index'])->name('index');
            Route::post('list', [PopularController::class, 'list'])->name('list');
            Route::post('store', [PopularController::class, 'store'])->name('store');
            Route::post('edit', [PopularController::class, 'edit'])->name('edit');
            Route::post('update', [PopularController::class, 'update'])->name('update');
            Route::delete('destroy', [PopularController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'chapter', 'as' => 'chapter.'], function(){
            Route::get('/', [ChapterController::class, 'index'])->name('index');
            Route::post('list', [ChapterController::class, 'list'])->name('list');
            Route::post('show', [ChapterController::class, 'show'])->name('show');
            Route::delete('destroy', [ChapterController::class, 'destroy'])->name('destroy');
            Route::post('queue', [ChapterController::class, 'queue'])->name('queue');
        });

        // GRABBER
        Route::group(['prefix' => 'grabber', 'as' => 'grabber.'], function(){
            Route::get('/', [GrabberController::class, 'index'])->name('index');
            Route::post('list', [GrabberController::class, 'list'])->name('list');
            Route::delete('destroy', [GrabberController::class, 'destroy'])->name('destroy');
            Route::post('queue', [GrabberController::class, 'queue'])->name('queue');

            Route::group(['prefix' => 'all', 'as' => 'all.'], function(){
                Route::get('comic', [GrabberController::class, 'comic'])->name('comic');
                Route::get('detail', [GrabberController::class, 'detail'])->name('detail');
                Route::get('chapter', [GrabberController::class, 'chapter'])->name('chapter');
            });
        });

        // QUEUE
        Route::group(['prefix' => 'queue', 'as' => 'queue.'], function(){
            Route::get('/', [QueueController::class, 'index'])->name('index');
            Route::post('list', [QueueController::class, 'list'])->name('list');
            Route::delete('destroy', [QueueController::class, 'destroy'])->name('destroy');
        });

        // AUDIT
        Route::group(['prefix' => 'audit', 'as' => 'audit.'], function(){
            Route::group(['prefix' => 'user', 'as' => 'user.'], function(){
                Route::get('/', [AuditUserController::class, 'index'])->name('index');
                Route::post('list', [AuditUserController::class, 'list'])->name('list');
            });
            Route::group(['prefix' => 'queue', 'as' => 'queue.'], function(){
                Route::get('/', [AuditQueueController::class, 'index'])->name('index');
                Route::post('list', [AuditQueueController::class, 'list'])->name('list');
            });
        });

        Route::group(['prefix' => 'setting', 'as' => 'setting.'], function(){
            Route::get('/', [SettingController::class, 'index'])->name('index');

            Route::group(['prefix' => 'password', 'as' => 'password.'], function(){
                Route::get('/', [PasswordController::class, 'index'])->name('index');
                Route::post('check', [PasswordController::class, 'check'])->name('check');
                Route::post('update', [PasswordController::class, 'update'])->name('update');
            });
        });

        Route::any('/grab/{action?}/{param?}', function ($action='index'){
            return App::call([GrabController::class,$action], []);
        });
    });
});

Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('php', function(){ return phpinfo(); });

Route::get('test/goutte-detail',[HomeController::class, 'goutte']);
Route::get('test/guzzle-detail',[HomeController::class, 'guzzle']);
Route::get('disconnect', function(){
    \Auth::logout();
});