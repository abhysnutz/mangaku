<?php

namespace App\Http\Controllers\Audit;

use App\Events\grabberEvent;
use App\Http\Controllers\Controller;
use App\Models\Audit\AuditGrabber;
use Illuminate\Http\Request;

class AuditGrabberController extends Controller
{
    public function index(){
        return view('backend.audit.grabber.index');
    }

    public function list(Request $request){

        $auditGrabber = AuditGrabber::with('grabber')->orderBy('id', 'DESC')->paginate(15);
        
        return response()->json($auditGrabber, 200);
    }

    public function grabber($data, $channel){
        $create = AuditGrabber::create($data);

        if($create){
            $auditGrabber = AuditGrabber::with('grabber')->where('id', $create->id)->first();
            grabberEvent::dispatch('.'.$channel,$auditGrabber);
        }
    }
}