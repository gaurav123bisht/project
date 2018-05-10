<?php

namespace App\Http\Controllers;
use validator;
use App\User;
use Datatables;
use Illuminate\Http\Request;

class AjaxdataController extends Controller
{
	//getdata() is used to get data and display on the datatable..........................
    function getdata()
    {
    	$student=User::select('id','name','email');
    	return Datatables::of($student)->addColumn('action',function($student){
    		return '<a href="'.route('edit',$student->id).'" class="btn btn-success">
    		<i class="glyphicon glyphicon-edit"></i>Edit</a>
    		<a href="'.route('delete',$student->id).'" class="btn btn-info"
    		<i class="glyphicon glyphicon-delete"></i>Delete</a>';
    	})->make(true);
    }

//fetchdata() is used to fetch particular user data and send it to ajax request in json format............................................................................
    function fetchdata(Request $request)
    {
        $id = $request->input('id');
        $student = User::find($id);
        $output = array(
            'name'    =>  $student->name,
            'email'     =>  $student->email
        );
        echo json_encode($output);
    }

    //postdata() is used for insert and update the data...................................
    function postdata(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email'  => 'required',
        ]);
        
        $error_array = array();
        $success_output = '';
        if ($validation->fails())
        {
            foreach ($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages; 
            }
        }
        else
        {
            if($request->get('button_action') == 'insert')
            {
                $user = new User([
                    'name'    =>  $request->get('name'),
                    'email'     =>  $request->get('email')
                ]);
                $user->save();
                $success_output = '<div class="alert alert-success">Data Inserted</div>';
            }

            if($request->get('button_action') == 'update')
            {
                $student = User::find($request->get('id'));
                $student->name = $request->get('name');
                $student->email = $request->get('email');
                $student->save();
                $success_output = '<div class="alert alert-success">Data Updated</div>';
            }
            
        }
        
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }

}

?>
