<?php

namespace App\Http\Controllers\Audit;

use App\Http\Controllers\Controller;
use App\Models\Audit\AuditUser;
use Illuminate\Http\Request;

class AuditUserController extends Controller
{
    public function index(){
        return view('backend.audit.user.index');
    }

    public function list(Request $request){
        // $auditUsers = Comic::with('detail');

        // if($request->search) $auditUsers = $auditUsers->where('title', 'LIKE', '%'.$request->search.'%');

        $auditUsers = AuditUser::orderBy('id', 'DESC')->paginate(15);
        
        return response()->json($auditUsers, 200);
    }
}
