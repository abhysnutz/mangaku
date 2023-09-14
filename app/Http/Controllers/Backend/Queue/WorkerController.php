<?php

namespace App\Http\Controllers\Backend\Queue;

use App\Events\Audit\QueueEvent;
use App\Http\Controllers\Controller;
use App\Models\Audit\AuditQueue;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Comic\Comic;
use App\Models\ComicDetail;
use App\Models\Image;
use App\Models\Queue;
use Goutte;
use Illuminate\Support\Facades\Storage;

class WorkerController extends Controller
{
    // LATEST
    public function latest($queue_id){
        $data_audit['queue_id'] = $queue_id;
        $data_audit['url'] = 'https://kiryuu.id';
        $crawler = Goutte::request('GET', $data_audit['url']);

        $title = $crawler->filter('.listupd > .utao > .uta > .luf > a')->each(function ($node) {
            return $node->text();
        });

        $link = $crawler->filter('.listupd > .utao > .uta > .luf > a')->extract(array('href'));

        for ($i=count($title) - 1; $i >= 0 ; $i--) {
            $slug[$i] = \Str::slug($title[$i]);
            $url[$i] = $link[$i];;
            try{
                if($i > 8 && $i <= 38){
                    $comic = Comic::updateOrCreate(
                        ['title' => $title[$i]],
                        ['slug' => $slug[$i], 'url' => $url[$i]]
                    );
                    
                    if($comic){
                        $create = Queue::create([
                            'grabber_id' => 6,
                            'title' => 'Grab Comic : '.$comic->title,
                            'ref_id' => $comic->id,
                            'status' => 0,
                        ]);

                        if($create){
                            $queue = Queue::with('grabber')->where('id', $create->id)->first();
                            \App\Events\QueueEvent::dispatch('store', $queue);

                            $data_audit['status'] = 1;
                            $data_audit['msg'] = 'Push Comic : '.$comic->title.' to Queue';
                        }
                    }
                }else{
                    $comic = Comic::where('slug',$slug[$i])->first();
                    if($comic) {
                        $detail = ComicDetail::find($comic->id);
                        if($detail) {
                            $detail->update(['project' => 1]);
                            $data_audit['status'] = 1;
                            $data_audit['msg'] = 'Set : '.$comic->title.' as Project';
                        }else{
                            $data_audit['status'] = 0;
                            $data_audit['msg'] = 'Failed set : '.$comic->title.' as Project | No detail';
                        }
                    }
                }
            } catch (\Exception $exception) {
                $data_audit['status'] = 0;
                $data_audit['msg'] = $exception->getMessage();
            }

            $audit = AuditQueue::create($data_audit);

            if($audit){
                $auditQueue = AuditQueue::with('queue')->where('id', $audit->id)->first();
                QueueEvent::dispatch('all', 'comic', $auditQueue);
            }
        }

        return 1;
    }

    // ALL
    public function allComic($queue_id){
        $data_audit['queue_id'] = $queue_id;
        
        $data_audit['url'] = 'https://kiryuu.id/manga/list-mode';

        $crawler = Goutte::request('GET', $data_audit['url']);
        
        $title = $crawler->filter('.soralist > .blix > ul > li > .series')->each(function ($node) {
            return $node->text();
        });

        $link = $crawler->filter('.soralist > .blix > ul > li > a')->extract(array('href'));

        for ($i=0; $i < count($title) ; $i++) {
            $slug[$i] = \Str::slug($title[$i]);
            $url[$i] = $link[$i] ?? '-';
                
            try {
                $check = Comic::where('title', $title[$i])->count();

                if($check){
                    $data_audit['msg'] = 'Comic '.$title[$i].' Has Exist';
                }else{
                    $comic = Comic::Create([ 'title' => $title[$i], 'slug' => $slug[$i], 'url' => $url[$i], 'created_at' ]);
                    if($comic){
                        $data_audit['status'] = 1;
                        $data_audit['msg'] = 'Comic : '.$comic->title;
                    }
                }
                
            } catch (\Exception $exception) {
                $data_audit['status'] = 0;
                $data_audit['msg'] = $exception->getMessage();
            }

            $audit = AuditQueue::create($data_audit);

            if($audit){
                $auditQueue = AuditQueue::with('queue')->where('id', $audit->id)->first();
                QueueEvent::dispatch('all', 'comic', $auditQueue);
            }
        }

        return 1;
    }

    public function allDetail($queue_id){
        $comics = Comic::all();
        
        foreach($comics as $comic){
            $this->detail($queue_id, $comic);
        }
        return 1;
    }

    public function allChapter($queue_id){
        $comics = Comic::all();
        
        foreach($comics as $comic){
            $this->chapter($queue_id, $comic);
        }

        return 1;
    }

    public function allImage($queue_id){
        $chapters = Chapter::doesnthave('images')->limit(1000)->get();
        foreach ($chapters as $chapter) {
            $this->image($queue_id, $chapter);
        }
        return 1;
    }

    // SPEC
    public function comic($queue_id, $comic){
        // DETAIL
        $this->detail($queue_id, $comic);

        // CHAPTER
        $this->chapter($queue_id, $comic);

        // IMAGE
        $chapters = Chapter::doesnthave('images')->where('comic_id', $comic->id)->get();
        if($chapters){
            foreach($chapters as $chapter){
                $this->image($queue_id, $chapter);
            }
        }
        
        return 1;
    }

    public function detail($queue_id, $comic){
        try{
            $data_audit['queue_id'] = $queue_id;
            $data_audit['url'] = $comic->url;
    
            $crawler = Goutte::request('GET', $comic->url);

            try { $alias = $crawler->filter('.seriestualt')->text(); } catch (\Throwable $th) { $alias = '-'; }
            try { $description = $crawler->filter('.entry-content.entry-content-single > p')->text(); } catch (\Throwable $th) { $description = '-'; }

            $details = $crawler->filter('.infotable tr')->each(function ($node) {
                return $node->text();
            });
           
            // GENRE CRAWL
            $genres = $crawler->filter('.seriestugenre > a')->each(function ($node) {
                return $node->text();
            });

            try { $rating = $crawler->filter('.rating.bixbox > .rating-prc > .num')->text(); } catch (\Throwable $th) { $rating = 0; }
            try { $followed = $crawler->filter('.bmc')->text(); } catch (\Throwable $th) { $followed = 0; }
            try { $image = $crawler->filter('.thumb img')->attr("src"); } catch (\Throwable $th) { $image = NULL; }
            try { $imageBg = $crawler->filter('.bigbanner')->attr("style"); } catch (\Throwable $th) { $imageBg = NULL; }
            try { $color = $crawler->filter('.thumb > .colored')->text(); } catch (\Throwable $th) { $color = NULL; }

            // SET DEFAULT VALUE
            foreach ($details as $key => $detail) {
                if(strstr($detail,'Status '))        $status         = trim(str_replace('Status','',$detail));
                if(strstr($detail,'Type '))          $type           = trim(str_replace('Type','',$detail));
                if(strstr($detail,'Released '))      $released       = trim(str_replace('Released','',$detail));
                if(strstr($detail,'Author '))        $author         = trim(str_replace('Author','',$detail));
                if(strstr($detail,'Artist '))        $artist         = trim(str_replace('Artist','',$detail));
                if(strstr($detail,'Serialization ')) $serialization  = trim(str_replace('Serialization','',$detail));
                if(strstr($detail,'Posted By '))     $posted_by      = trim(str_replace('Posted By','',$detail));
                if(strstr($detail,'Posted On '))     $posted_on      = trim(str_replace('Posted On','',$detail));
                if(strstr($detail,'Updated On '))    $Updated_on     = trim(str_replace('Updated On','',$detail));
            }

            $imageBg = ($imageBg) ? trim(str_replace(["background-image: url('","');"],"",$imageBg)) : NULL;
            
            $update = ComicDetail::updateOrCreate(
                                    [ 'id' => $comic->id ],
                                    [ 'comic_id' => $comic->id, 'alias' => $alias ?? '-', 'description'  => $description ?? '-', 'status' => $status ?? 'Ongoing', 'type' => $type ?? 'Manga', 'released' => $released ?? '-', 'author' => $author ?? '-', 'artist' => $artist ?? '-', 'serialization' => $serialization ?? '-', 'posted_by'  => 'Abhysnutz', 'posted_on'  => NOW(), 'rating'  => $rating ?? 0, 'color'  => $color ? 1 : 0, 'follower'  => $followed ? trim(str_replace(['Followed','by','people'],'',$followed)) : 0 ]);

            if($update){
                $data_audit['status'] = 1;
                $data_audit['msg'] = 'Detail Comic : '.$comic->title;
            }

            // INSERT KATEGORI DETAIL
            $category_id =[];
            foreach($genres as $key => $genre){
                if($key != 0){
                    $category = Category::firstOrCreate(['title' => $genre], ['slug' => \Str::slug($genre)] );
                    $category_id[] = $category->id;
                }
            }
            if($category_id) $comic->categories()->sync($category_id);

            $comicDetail = ComicDetail::find($comic->id);

            if($comicDetail->image == 0){
                if($image){
                    try { $storage = Storage::put('public/comic/image/'.$comic->slug.'.jpg', file_get_contents($image)); } catch (\Throwable $th) { $storage = NULL; }
                    if($storage) {
                        $comicDetail->update(['image' => 1]);
                        try { 
                            $image = Storage::disk('public')->get('comic/image/'.$comic->slug.'.jpg');
                            if($image){
                                $thumbnail = \Image::make($image)->resize(75,100)->encode();
                                Storage::put('public/comic/thumbnail/'.$comic->slug.'.jpg', $thumbnail); 
                            }
                        } catch (\Throwable $th) { }
                    }
                }
            }

            if($comicDetail->bg_image == 0){
                if($imageBg){
                    try { $storageBg = Storage::put('public/comic/image-bg/'.$comic->slug.'.jpg', file_get_contents($imageBg)); } catch (\Throwable $th) { $storageBg = NULL; }
                    if($storageBg) $comicDetail->update(['bg_image' => 1]);
                }
            }
        } catch (\Exception $exception) {
            $data_audit['status'] = 0;
            $data_audit['msg'] = 'Detail Comic : '.$comic->title.' : '.$exception->getMessage();;
        }
        
        $create = AuditQueue::create($data_audit);

        if($create){
            $auditQueue = AuditQueue::with('queue')->where('id', $create->id)->first();
            QueueEvent::dispatch('all', 'comic', $auditQueue);
        }
    }

    public function chapter($queue_id, $comic){
        $data_audit['queue_id'] = $queue_id;
        $data_audit['url'] = $comic->url;
        $data_audit['status'] = 1;
        $data_audit['msg'] = 'Comic : '.$comic->title.' - Check Chapter';
        
        $crawler = Goutte::request('GET', $data_audit['url']);

        $chapterCrawler = $crawler->filter('.clstyle > li > .chbox')->each(function ($node) {
            return $node->html();
        });

        for($i = count($chapterCrawler) - 1; $i >= 0 ; $i--){
            $url[$i] = explode('/"', explode('<a href="', $chapterCrawler[$i])[1])[0];
            $title[$i] = trim(str_replace('Chapter','',explode('</span>', explode('<span class="chapternum">', $chapterCrawler[$i])[1])[0]));
            $episode_chapter[$i] = ltrim($title[$i],'0');
            $slug[$i] = str_replace('https://kiryuu.id/','',$url[$i]);
        }

        $order = 1;
        for($i = count($chapterCrawler) - 1; $i > 0 ; $i--){
            try {
                for($i = count($chapterCrawler) - 1; $i >= 0 ; $i--){
                    Chapter::updateOrCreate(
                        ['comic_id' => $comic->id, 'episode' => $episode_chapter[$i], 'slug'=> $slug[$i]],
                        ['title' => 'Chapter '.$title[$i], 'url' => $url[$i], 'order' => $order]
                    );
                    $order++;
                }
            }catch (\Exception $exception) {
                $data_audit['status'] = 0;
                $data_audit['msg'] = 'Comic : '.$comic->title.' - Chapter : '.$episode_chapter[$i].' : '.$exception->getMessage();;
            }
        }

        $create = AuditQueue::create($data_audit);

        if($create){
            $auditQueue = AuditQueue::with('queue')->where('id', $create->id)->first();
            QueueEvent::dispatch('all', 'comic', $auditQueue);
        }
    }

    public function image($queue_id, $chapter){
        try{
            $data_audit['queue_id'] = $queue_id;
            $data_audit['url'] = $chapter->url;
        
            $crawler = Goutte::request('GET', $chapter->url);

            $images = $crawler->filter('#readerarea img')->each(function ($node){
                return $node->attr('src');
            });
            
            $order = 1;
            foreach ($images as $image) {
                if($image){
                    Image::updateOrCreate(
                        ['chapter_id' => $chapter->id, 'order' => $order],
                        ['url' => trim($image)]
                    );
                    $order++;
                }
            }
            
            Comic::find($chapter->comic_id)->touch();
            Chapter::find($chapter->id)->touch();

            $data_audit['status'] = 1;
            $data_audit['msg'] = 'Comic : '.$chapter->comic->title.' Image Chapter : '.$chapter->title;
        } catch (\Exception $exception) {
            $data_audit['status'] = 0;
            $data_audit['msg'] = 'Grabber failed -> Comic : '.$chapter->comic->title ?? '-'.' Image Chapter : '.$chapter->title ?? '-'.' : '.$exception->getMessage();;
        }

        $create = AuditQueue::create($data_audit);

        if($create){
            $auditQueue = AuditQueue::with('queue')->where('id', $create->id)->first();
            QueueEvent::dispatch('all', 'comic', $auditQueue);
        }

        return 1;
    }
}