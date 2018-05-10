<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
//addItem() IS THE CONTROLLER LOGIC TO ADD AN ITEM IN THE DATABASE..................................................................................
    public function addItem(Request $request) 
    {
		    $rules = array (
		            'name' => 'required'
		    );
		    $validator = Validator::make ( Input::all (), $rules );
		    if ($validator->fails ())
		        return Response::json ( array (
		                    
		                'errors' => $validator->getMessageBag ()->toArray ()
		        ) );
		        else {
		            $data = new User ();
		            $data->name = $request->name;
		            $data->save ();
		            return response ()->json ( $data );
    				  }
    }



//readItems() IS THE CONTROLLER LOGIC TO READ DATA FROM TABLULAR  FORMAT AND APPLY FOR THE DELETE AND EDIT OPTION...............................................................
	public function readItems(Request $req) 
	{
	    $data = User::all ();
	    return view ( 'ajax' )->withData ( $data );
	} 


//CONTROLLER LOGIC TO UPDATE AN RECORD FROM THE TABULAR FORMAT DATA.................................................................................................................
public function editItem(Request $req) 
	{
		
		 //return 'hhhhhhhhhhhh';
        $data = User::find($req->id);
        $data->name = $req->name;
        if($data->save())
        {
        	$data=User::find($req->id);
        	return response ()->json ( $data );
        }
        
        
    }	

//CONTROLLER LOGIC TO DELETE AN RECORD ............................................................................................................................................\
  public function deleteItem(Request $req) 
  	{
  		// return 'hhhhhhhhhhhh';
        User::find ( $req->id )->delete ();
        return response ()->json ();
    }
}
