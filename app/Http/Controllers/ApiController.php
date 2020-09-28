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
            'message' => 'Item added successfully',
            'data' => $item
        ]); 

    }

    public function getAllItems(){
        $item = Item::all();

        return response()->json([
            'data' => $item
        ]);
    }

    public function deleteItem($id){
        $item = Item::find($id);
        $item->delete();

        return response()->json([
            'message' => 'Item deleted successfully'
        ]);
    }

    public function updateItem(Request $request, $id){
        $item = Item::find($id);

        $this->validate($request, [
            'name' => 'required|string|min:4',
            'description' => 'required|string|min:10'
        ]);

        $item->name = $request->name;
        $item->description = $request->description;
        $item->save();

        return response()->json([
            'message' => 'Item updated successfully!',
            'data' => $item 
        ]);

    }
}
