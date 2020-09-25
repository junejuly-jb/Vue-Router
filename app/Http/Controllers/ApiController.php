<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Validator;

class ApiController extends Controller
{
    public function createItem(Request $request){

        $this->validate($request, [
            'name' => 'required|string|min:4',
            'description' => 'required|string|min:10'
        ]);


        $item = new Item([
            'name' => $request->name,
            'description' => $request->description
        ]);

        $item->save();
        return response()->json([
            'message' => 'added successfully',
            'data' => $item
        ]); 

    }
}
