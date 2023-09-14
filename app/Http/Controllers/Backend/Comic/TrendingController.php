<?php

namespace App\Http\Controllers\Backend\Comic;

use App\Http\Controllers\Controller;
use App\Models\Comic\Comic;
use App\Models\Comic\ComicTrending;
use Illuminate\Http\Request;

class TrendingController extends Controller
{
    public function index(){
        $comics = Comic::orderBy('title', 'ASC')->doesnthave('trending')->get();
        return view('backend.trending.index', compact('comics'));
    }

    public function list(Request $request){
        $result =[];
        $comics = Comic::orderBy('title', 'ASC')->doesnthave('trending')->get();
        $trendings = ComicTrending::with('comic');

        if($request->search) {
            $search = $request->search;
            $trendings = $trendings->wherehas('comic', function($query) use ($search){
               $query->where('title', 'LIKE', '%'.$search.'%');
            });
        }

        $trendings = $trendings->orderBy('order', 'ASC')->paginate(15);

        $result['comics'] = $comics->toArray();
        $result['trendings'] = $trendings->toArray();
        return response()->json($result, 200);
    }

    public function store(Request $request){
        $data = $request->all();
        $result = [];
        $result['status'] = 0;

        if($data){
            $trending = ComicTrending::create($data);
            if($trending) $result['status'] = 1;
        }
        
        return response($result, 200);
    }

    public function edit(Request $request){
        $trending = ComicTrending::with('comic')->find($request->id);
        return response()->json($trending->toArray(), 200);
    }

    public function update(Request $request){
        $result = [];
        $result['status'] = 0;

        if($request->id){
            $trending = ComicTrending::find($request->id);
            $update = $trending->update($request->all());

            if($update) $result['status'] = 1;
        }

        return response()->json($result, 200);
    }

    public function destroy(Request $request){
        $result = [];
        $result['status'] = 0;

        if($request->id){
            $trending = ComicTrending::find($request->id);
            $delete = $trending->delete();

            if($delete) $result['status'] = 1;
        }

        return response()->json($result, 200);
    }
}