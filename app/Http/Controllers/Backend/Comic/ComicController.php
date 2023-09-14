<?php

namespace App\Http\Controllers\Backend\Comic;

use App\Events\QueueEvent;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comic\Comic;
use App\Models\Queue;
use Illuminate\Http\Request;

class ComicController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('title','ASC')->get();
        return view('backend.comic.index', compact('categories'));
    }

    public function list(Request $request){
        $comics = Comic::with('detail');

        if($request->search) $comics = $comics->where('title', 'LIKE', '%'.$request->search.'%');

        $comics = $comics->orderBy('title', 'ASC')->paginate(15);

        return response()->json($comics, 200);
    }

    public function edit(Request $request){
        $comic = Comic::with('detail')->where('id', $request->id)->first();
        return response()->json($comic, 200);
    }

    public function destroy(Request $request){
        $result = [];
        $result['status'] = 0;

        if($request->id){
            $comic = Comic::find($request->id);
            if($comic){
                if($comic->delete()){
                    $result['status'] = 1;
                }
            }
        }
        return response()->json($result, 200);
    }

    public function queue(Request $request){
        $result = [];
        $result['status'] = 0;
        
        if($request->id){
            $comic = Comic::find($request->id);
            $create = Queue::create([
                'grabber_id' => 6,
                'title' => 'Grab Comic : '.$comic->title,
                'ref_id' => $request->id,
                'status' => 0,
            ]);

            if($create){
                $queue = Queue::with('grabber')->where('id', $create->id)->first();
                QueueEvent::dispatch('store', $queue);
                $result['status'] = 1;
            }
        }

        return response()->json($result, 200);
    }
}