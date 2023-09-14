<?php

namespace App\Http\Controllers\Backend\Grabber;

use App\Events\QueueEvent;
use App\Http\Controllers\Controller;
use App\Models\Grabber;
use App\Models\Queue;
use Illuminate\Http\Request;

class GrabberController extends Controller
{
    public function index(){
        return view('backend.grabber.index');
    }

    public function list(){
        $grabbers = Grabber::paginate(15);

        return response()->json($grabbers, 200);
    }

    public function queue(Request $request){
        $result = [];
        $result['status'] = 0;

        if($request->id){
            $grabber = Grabber::find($request->id);
            if($grabber){
                $create = Queue::create([
                    'grabber_id' => $grabber->id,
                    'title' => $grabber->title,
                    'status' => 0,
                ]);

                if($create){
                    $queue = Queue::with('grabber')->where('id', $create->id)->first();
                    QueueEvent::dispatch('store', $queue);
                    $result['status'] = 1;
                }
            }
        }

        return response()->json($result, 200);
    }

    public function destroy(Request $request){
        $result = [];
        $result['status'] = 0;

        if($request->id){
            $grabber = Grabber::find($request->id);
            if($grabber){
                if($grabber->delete()){
                    $result['status'] = 1;
                }
            }
        }
        return response()->json($result, 200);
    }
}