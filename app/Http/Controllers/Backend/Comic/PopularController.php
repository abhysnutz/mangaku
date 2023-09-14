<?php

namespace App\Http\Controllers\Backend\Comic;

use App\Http\Controllers\Controller;
use App\Models\Comic\Comic;
use App\Models\Comic\ComicPopular;
use Illuminate\Http\Request;

class PopularController extends Controller
{
    public function index(){
        $comics = Comic::orderBy('title', 'ASC')->doesnthave('popular')->get();
        return view('backend.popular.index', compact('comics'));
    }

    public function list(Request $request){
        $result =[];
        $comics = Comic::orderBy('title', 'ASC')->doesnthave('popular')->get();
        $populars = ComicPopular::with('comic');

        if($request->search) {
            $search = $request->search;
            $populars = $populars->wherehas('comic', function($query) use ($search){
               $query->where('title', 'LIKE', '%'.$search.'%');
            });
        }

        $populars = $populars->orderBy('order', 'ASC')->paginate(15);

        $result['comics'] = $comics->toArray();
        $result['populars'] = $populars->toArray();
        return response()->json($result, 200);
    }

    public function store(Request $request){
        $data = $request->all();
        $result = [];
        $result['status'] = 0;

        if($data){
            $popular = ComicPopular::create($data);
            if($popular) $result['status'] = 1;
        }
        
        return response($result, 200);
    }

    public function edit(Request $request){
        $popular = ComicPopular::with('comic')->find($request->id);
        return response()->json($popular->toArray(), 200);
    }

    public function update(Request $request){
        $result = [];
        $result['status'] = 0;

        if($request->id){
            $popular = ComicPopular::find($request->id);
            $update = $popular->update($request->all());

            if($update) $result['status'] = 1;
        }

        return response()->json($result, 200);
    }

    public function destroy(Request $request){
        $result = [];
        $result['status'] = 0;

        if($request->id){
            $popular = ComicPopular::find($request->id);
            $delete = $popular->delete();

            if($delete) $result['status'] = 1;
        }

        return response()->json($result, 200);
    }
}
