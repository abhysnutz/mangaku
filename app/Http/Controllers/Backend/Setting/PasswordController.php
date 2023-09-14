<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function index(){
        return view('backend.setting.password');
    }

    public function check(Request $request){
        $user = Auth::user();
        $result = false;
        if($user){
            if (Hash::check($request->old, $user->password)) {
                $result = true;
            }
        }

        return response()->json($result, 200);
    }

    public function update(Request $request){
        $result = false;
        if(Auth::user()){
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->password)
            ]);
            $result = true;
        }
        return response()->json($result, 200);
    }
}
