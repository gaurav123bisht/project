<?php

namespace App\Http\Controllers;
use App\State;
use Illuminate\Http\Request;
use Validator;
use App\District;
use App\City;
use App\Post;
class IndexPaypalController extends Controller
{
    /*
    displaying posts

    */
    public function state()
    {

         $items = State::all(['id', 'name']);
          return response ()->json ( $items );
    
    }

    public function district(Request $req)
    {
        //District::find(['id','name'])->where('id','=',$req->state_id)
        $district=District::where('state_id','=',$req->state_id)->get();
        return response()->json($district);
    }

     public function city(Request $request)
    {
        
        $city=City::where('district_id','=',$request->district_id)->get();
        
        return response()->json($city);
    }

    public function readItems()
    {
        $data=Post::all();
        return view('ajax_crud_paypal')->with('data',$data);
    }

    /*
    adding Posts
    */

    public function addItem(Request $req) {
        
       
                $data = new Post;
                $data->title = $req->title;
                $data->description=$req->description;
                $data->save();
                return response()->json ($data );
            



        // $rules = array (
     //        'title' => 'required',
     //        'description' =>'required'
        // );
        // $validator = Validator::make ( Input::all (), $rules );
        // if ($validator->fails ())
        //     return Response::json ( array (
                        
        //             'errors' => $validator->getMessageBag ()->toArray()
        //     ) );
        //     else {
        //         $data = new Post;
        //         $data->title = $req->title;
     //            $data->description=$req->description;
        //         $data->save();
        //         return response()->json ($data );
        //     }
    }

    /*
    update operation
    */
    public function editItem(Request $req) {
         $data = Post::find( $req->id );
        $data->title = $req->name;
        $data->description=$req->description;
        $data->save ();
        return response ()->json ( $data );
    }

    /*
    delete operation
    */
    public function deleteItem(Request $req) {
        Post::find ( $req->id )->delete ();
        return response ()->json ();
    }
}