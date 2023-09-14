<?php

namespace App\Http\Controllers\Backend\Grab;

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
use Carbon\Carbon;
use GuzzleHttp\Client;


class GrabController extends Controller
{
    public static function grabber(){
        $progress = Queue::where('status', 1)->first();
        $audit = $progress->audits->first();
        $now = Carbon::now();
        $end_date = Carbon::parse($audit->created_at);

        $diff = $now->diffInMinutes($end_date);
        if($diff > 3){
            // echo $diff;
            // echo $progress->id;
            Queue::find($progress->id)->update(['status' => 0]);
        }
    }

    public static function new(){
        $crawler = Goutte::request('GET', 'https://kiryuu.id');

        $title = $crawler->filter('.listupd > .utao > .uta > .luf > a')->each(function ($node) {
            return $node->text();
        });

        $link = $crawler->filter('.listupd > .utao > .uta > .luf > a')->extract(array('href'));

        for ($i=count($title) - 1; $i >= 0 ; $i--) {
            $slug[$i] = \Str::slug($title[$i]);
            $url[$i] = $link[$i];

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
                    }
                }
            }else{
                $comic = Comic::where('slug',$slug[$i])->first();
                if($comic) {
                    $detail = ComicDetail::find($comic->id);
                    if($detail) {
                        $detail->update(['project' => 1]);
                    }
                }
            }
        }
    }
    public static function comic(){
        $crawler = Goutte::request('GET', 'https://kiryuu.id/manga/list-mode');
            
        $title = $crawler->filter('.soralist > .blix > ul > li > .series')->each(function ($node) {
            return $node->text();
        });

        $link = $crawler->filter('.soralist > .blix > ul > li > a')->extract(array('href'));

        for ($i=0; $i < count($title) ; $i++) {
            $slug[$i] = \Str::slug($title[$i]);
            $url[$i] = $link[$i] ?? '-';

            Comic::updateOrCreate(
                    ['title' => $title[$i]],
                    ['slug' => $slug[$i], 'url' => $url[$i], 'created_at']
                );
        }
    }

    public static function detail(){
        
        $comics = Comic::doesnthave('detail')->get();
        // $comic = Comic::find(6);
        foreach($comics as $comic){
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

            // SET VALUE
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
            
            ComicDetail::updateOrCreate(
                [ 'id' => $comic->id ],
                [
                    'comic_id' => $comic->id,
                    'alias' => $alias ?? '-',
                    'description'  => $description ?? '-',
                    'status' => $status ?? 'Ongoing',
                    'type' => $type ?? 'Manga',
                    'released' => $released ?? '-',
                    'author' => $author ?? '-',
                    'artist' => $artist ?? '-',
                    'serialization' => $serialization ?? '-',
                    'posted_by'  => 'Abhysnutz',
                    'posted_on'  => NOW(),
                    'rating'  => $rating ?? 0,
                    'color'  => $color ? 1 : 0,
                    'follower'  => $followed ? trim(str_replace(['Followed','by','people'],'',$followed)) : 0
                ]);
                

            // // INSERT KATEGORI DETAIL
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
        }
    }

    public static function chapter(){
        $exclude = ['beelzebub'];
        $comics = Comic::doesnthave('chapters')->whereNotIn('slug',$exclude)->orderBy('id','ASC')->get();
        
        // $comic = Comic::find(2);
        
        foreach($comics as $comic){
            $crawler = Goutte::request('GET', $comic->url);

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
            for($i = count($chapterCrawler) - 1; $i >= 0 ; $i--){
                $episode_chapter[$i] = $episode_chapter[$i] ? $episode_chapter[$i] : '0';
                $chapter[$i] = Chapter::where('comic_id', $comic->id)->where('episode', $episode_chapter[$i])->where('slug',$slug[$i])->first();
                if(!$chapter[$i]){
                    Chapter::Create(
                        ['comic_id' => $comic->id, 'episode' => $episode_chapter[$i], 'slug'=> $slug[$i],
                        'title' => 'Chapter '.$title[$i], 'url' => $url[$i], 'order' => $order]
                    );
                    // Chapter::updateOrCreate(
                    //     ['comic_id' => $comic->id, 'episode' => $episode_chapter[$i] ? $episode_chapter[$i] : '0', 'slug'=> $slug[$i]],
                    //     ['title' => 'Chapter '.$title[$i], 'url' => $url[$i], 'order' => $order]
                    // );
                }else{
                    Chapter::where('comic_id', $comic->id)->where('episode', $episode_chapter[$i])->where('slug',$slug[$i])->update(['title' => 'Chapter '.$title[$i], 'url' => $url[$i], 'order' => $order]);
                }
                $order++;
            }
        }
    }

    public static function image(){
        $chapters = Chapter::doesnthave('images')->select('id','comic_id','url')->limit(20000)->get();
        
        foreach ($chapters as $chapter) {
            $crawler = Goutte::request('GET', $chapter->url);

            $images = $crawler->filter('#readerarea img')->each(function ($node){
                return $node->attr('src');
            });

            Comic::find($chapter->comic_id)->touch();
            Chapter::find($chapter->id)->touch();
         
            $order = 1;
            foreach ($images as $image) {
                if($image){
                    Image::Create( ['chapter_id' => $chapter->id, 'order' => $order, 'url' => trim($image)]);
                    // Image::updateOrCreate(
                    //     ['chapter_id' => $chapter->id, 'order' => $order],
                    //     ['url' => trim($image)]
                    // );
                    $order++;
                }
            }
        }
    }

    public static function detail_image(){
        $comics = Comic::whereNotIn('slug', ['watashi-ga-inakute-mo-shiawase-ni-natte-kudasai-nante-fuzaken-na', '8-circle-wizards-reincarnation', 'because-im-an-uncle-who-runs-a-weapon-shop', 'beginners-test-for-infinite-power', 'ceos-top-master', 'i-was-beaten-up-by-the-boss', 'i-wont-get-bullied-by-girls', 'jingai-hime-sama-hajimemashita-free-life-fantasy', 'jojo-no-kimyou-na-bouken-jojorion', 'miss-sister-dont-mess-with-me', 'reincarnated-into-an-otome-game-nah-im-too-busy-mastering-magic', 'magicalexplorer-eroge-no-yuujin-kyara-ni-tensei-shitakedo-game-chishiki-tsukatte-jiyuu-ni-ikiru', 'senpai-lets-have-an-office-romance', 'the-evil-sorceress-plans-to-survive'])->whereHas('detail', function($query){
                            $query->where('image', 0);
                      })->get();
        foreach($comics as $comic){
            $crawler = Goutte::request('GET', $comic->url);

            $image = $crawler->filter('.ims img')->each(function ($node) {
                return $node->attr("src");
            });

            $image = $image[0] ?? NULL;
            
            if($image){
                $storage = Storage::put('public/comic/image/'.$comic->slug.'.jpg', file_get_contents($image));
                
                if($storage) {
                    ComicDetail::where('id', $comic->id)->update(['image' => 1]);

                    $image = Storage::disk('public')->get('comic/image/'.$comic->slug.'.jpg');

                    $thumbnail = \Image::make($image);
                    $thumbnail->resize(75, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('/storage/comic/thumbnail/').$comic->slug.'.jpg');
                }
            }
        }
    }

    public static function detail_bgimage(){
        $comics = Comic::whereHas('detail', function($query){
                            $query->where('bg_image', 0);
                      })->get();

        foreach($comics as $comic){
            $crawler = Goutte::request('GET', $comic->url);

            $imageBg = $crawler->filter('style')->each(function ($node) {
                return $node->html();
            });

            $imageBg = ($imageBg[1]) ? explode(");}}", explode("url(", $imageBg[1])[1])[0] : NULL;
            
            echo $comic->id.' - '.$comic->title.' - '.$comic->url.'a <br>';

            if($imageBg){
                $headerImageBg = get_headers($imageBg, TRUE)["Content-Type"][1] ?? "image";
                
                if($headerImageBg != "text/html") {
                    $storageBg = Storage::put('public/comic/image-bg/'.$comic->slug.'.jpg', file_get_contents($imageBg));

                    if($storageBg) ComicDetail::where('id', $comic->id)->update(['bg_image' => 1]);
                }

                echo $comic->id.' - '.$comic->title.' - '.$comic->url.'b <br>';
            }
        }
    }
}
