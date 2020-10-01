<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Validator;
use Intervention\Image\Facades\Image as Image;

class ApiController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }
    public function itemDetails($id){
        $item = Item::find($id);

        return response()->json([
            'message' => 'success',
            'data' => $item
        ]);
    }
    public function updatePP(Request $request){
        $user = auth('api')->user();
        $currentPhoto = $user->profile;

        if($request->photo != $currentPhoto || $user->photo == null){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            Image::make($request->photo)->fit(900, 900)->save(public_path('uploads/').$name);
            
            $user->profile = $name;
            $user->save();


            // $userPhoto = public_path('uploads/').$currentPhoto;
            $userPhoto = public_path('uploads/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }
        }
        

            return response()->json([
                'message' => 'Profile picture updated successfully!'
            ]);
    }
    public function updateUser(Request $request){
        $user = auth('api')->user();

        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'bio' => 'required'
        ]);

        $user->name = $request->name;
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
