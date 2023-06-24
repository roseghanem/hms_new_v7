<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Framework;
use App\Models\Framework as ModelsFramework;

class FrameworkController extends Controller
{
    public function index() 
    {
    	return view('framework');
    }

    public function store(Request $request)
    {
    	$input = $request->all();
    	$data = [];
    	$data['name'] = json_encode($input['name']);

    	ModelsFramework::create($data);
        return response()->json(['success'=>'Success Fully Insert Recoreds']);
    }
}
