<?php

namespace App\Http\Controllers\Audit;

use App\Http\Controllers\Controller;
use App\Models\Audit\AuditQueue;
use Illuminate\Http\Request;

class AuditQueueController extends Controller
{
    public function index(){
        return view('backend.audit.queue.index');
    }

    public function list(Request $request){

        $auditQueue = AuditQueue::with('queue')->orderBy('id', 'DESC')->paginate(15);
        
        return response()->json($auditQueue, 200);
    }

    public function grabber($data, $channel){
        $create = AuditGrabber::create($data);

        if($create){
            $auditGrabber = AuditGrabber::with('grabber')->where('id', $create->id)->first();
            grabberEvent::dispatch('.'.$channel,$auditGrabber);
        }
    }
}
