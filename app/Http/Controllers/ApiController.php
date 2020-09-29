<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Validator;

class ApiController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }
    public function updateUser(Request $request){
        $user = auth('api')->user();

        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'bio' => 'required'
        ]);

        $user->address = $request->address;
        $user->contact = $request->contact;
        $user->bio = $request->bio;
        $user->save();

        return response()->json([
            'message' => 'User updated successfully!'
        ]);

    }
    public function profile(){
        $user = auth('api')->user();

        return response()->json([
            'data' => $user
        ]);
    }
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
