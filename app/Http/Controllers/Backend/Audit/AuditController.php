<?php

namespace App\Http\Controllers\Backend\Audit;

use App\Http\Controllers\Controller;
use App\Models\Audit\AuditGrabber;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    

    public function index(){
        return view('backend.audit.index');
    }

    //Audit Grabber
    //Audit user
    //Audit Admin
}
