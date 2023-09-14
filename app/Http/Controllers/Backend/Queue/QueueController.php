<?php

namespace App\Http\Controllers\Backend\Queue;

use App\Http\Controllers\Controller;
use App\Models\Queue;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function index()
    {
        return view('backend.queue.index');
    }

    public function list(){
        $queues = Queue::with('grabber')->orderBy('id', 'DESC')->paginate(100);

        return response()->json($queues, 200);
    }

    public function destroy(Request $request){
        $result = [];
        $result['status'] = 0;

        if($request->id){
            $queue = Queue::find($request->id);
            if($queue){
                if($queue->delete()){
                    $result['status'] = 1;
                }
            }
        }
        return response()->json($result, 200);
    }
}
