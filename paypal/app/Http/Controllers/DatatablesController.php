<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\Datatables\Datatables;

class DatatablesController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
    	$users=User::select(['id','name','email']);
        return Datatables::of($users)
        ->addColumn('action',function($users){
        		return '<a href="'.route("delete",$users->id).'"class="btn btn-success"><i class="glyphicon glyphicon-delete"></i>Delete</a>
        		<a href="'.route("edit",$users->id).'"class="btn btn-danger"><i class="glyphicon glyphicon-edit"></i>Edit</a>';
        })->make(true);
    }


    public function deleteRecord($id)
    {
    	$record=User::find($id);
    	$response=$record->delete();

    	if($response==1)
    	{
    		return redirect()->back();
    	}
    }


    public function editRecord($id)
    {
    	$data=User::where('id','=',$id)->get();
    	//echo $data[0];exit;
    	
    	return view('update_data')->with('data',$data[0]);
    	


    }

    public function update(Request $request)
    { 
    	//echo $request->id;exit;

    	$res=User::where('id','=',$request->id)->update(['name'=>$request->name,'email'=>$request->email]);

    	if($res==1)
    	{

    		//return redirect()->back();
    		return redirect()->route('getindex');
    		
    	}
    }
}
