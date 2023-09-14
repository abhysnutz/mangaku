<?php

namespace App\Http\Controllers\Backend\Comic;

use App\Events\QueueEvent;
use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Comic\Comic;
use App\Models\Queue;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function index(){
        $comics = Comic::all();
        return view('backend.chapter.index', compact('comics'));
    }

    public function list(Request $request){
        $comic = Comic::find($request->comic_id);

        if($comic){
            $chapters = $comic->chapters();

            if($request->search) $chapters = $chapters->where('title', 'LIKE', '%'.$request->search.'%');

            $chapters = $chapters->orderBy('order', 'DESC')->paginate(15);
        }

        return response()->json($chapters, 200);
    }

    public function show(Request $request){
        $result = [];
        $result['status'] = 0;
        if($request->id){
            $chapter = Chapter::find($request->id);
            if($chapter){
                $result['data'] = $chapter->toArray();
                $result['images'] = $chapter->images()->orderBy('order','ASC')->get();
                $result['status'] = 1;
            }
        }
        
        return response()->json($result, 200);
    }

    public function destroy(Request $request){
        $result = [];
        $result['status'] = 0;

        if($request->id){
            $chapter = Chapter::find($request->id);
            if($chapter){
                if($chapter->delete()){
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
            $chapter = Chapter::find($request->id);

            $create = Queue::create([
                'grabber_id' => 7,
                'title' => 'Grab Comic : '.$chapter->comic->title.'. Chapter : '.$chapter->episode,
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
