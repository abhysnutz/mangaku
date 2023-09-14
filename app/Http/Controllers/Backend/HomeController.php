<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Goutte;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;
class HomeController extends Controller
{
    public function index(){
        return view('backend.index');
    }

    public function goutte(){
        $crawler = Goutte::request('GET', 'https://mangaku.fun/');

        // // DETAIL CRAWL
        // $detail = $crawler->filter('.inftable td')->each(function ($node) {
        //     return $node->text();
        // });
        
        // // SINOPSIS CRAWL
        // $sinopsis = $crawler->filter('.sec')->each(function ($node) {
        //     return $node->html();
        // });

        // // GENRE CRAWL
        // $genres = $crawler->filter('.genre')->each(function ($node) {
        //     return $node->text();
        // });

        // // // IMAGE SAMPUL
        // $image = $crawler->filter('.ims img')->each(function ($node) {
        //     return $node->attr("src");
        // });

        // // // IMAGE BACKGROUND
        // $imageBg = $crawler->filter('style')->each(function ($node) {
        //     return $node->html();
        // });

        // // // IMAGE BACKGROUND
        $html = $crawler->filter('html')->each(function ($node) {
            return $node->html();
        });

        echo '<pre>';
        print_r($html);
        echo '</pre>';

    }

    public function guzzle(){
        
        $client = new Client();
        $res = $client->request('GET', 'https://kiryuu.id');
        echo $res->getBody();

    }
}
