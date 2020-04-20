<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;
use App\Voter;
use Excel;
use App\Imports\ImportVoter;
use Redirect,Response;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
class MainController extends Controller
{

public function __construct()
{
        
 }
 



    function login()
    {

     return view('login');
    }

   
    

    function  home()
    {

        // do what you need to do
   if(Auth::user()){
       return view('dashboard');
    }else {
      return redirect('/');
    }

    
    }

    function logout()
    {
      if(Auth::user()){
        Auth::logout();
       }
     return redirect('/');
    }



     function  storeVoter()
    {
        return Datatables::of(Voter::select("id","name","email"))
        ->addColumn('action', '
            <center>
             <a href="#"   data-id="{{ $id }}" data-original-title="Edit" class="edit btn btn-success edit-user"  data-toggle="modal" data-target="#ajax-crud-modal">
            <i class="fa fa-edit"></i>
              </a>
               
           <a href="#" class="btn btn-danger" onclick="deleteVoter({{$id}})"><i class="fa fa-trash"></i></a>
              </center> ')
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);
       
    }


   function importVoter(Request $request){
     if(Auth::user()){    
      try {
        $uploadedFile = $request->file('file'); 
          Excel::import(new ImportVoter, $uploadedFile);
          return Redirect::back();
      } catch (Exception $e) {
              return Redirect::back();
      }

    }

   }





  function getVoter($id){
      if(Auth::User()){
      $data=Voter::find($id);
      return $data;    
      } 
    }

function saveVoter(Request $request){
     if(Auth::User()){
     $voterId = $request->user_id;
     $voter=Voter::find($voterId);
     $voter->name=$request->name;
     $voter->email=$request->email;
     $voter->save();
     return Response::json($voter);
   }
}
    
   function createVoter(Request $request){
     if(Auth::User()){
    $voter_data = array(
      'email'  => $request->get('email'),
      'name' => $request->get('name'),
       'password'  => Hash::make($request->get('password')),
     );
     $voter = Voter::create($voter_data);         
     return Response::json($voter);
     }
   }
     

    function deleteVoter($id){
    if(Auth::user()){
     $voter=Voter::find($id);
     $voter->delete();
    return Response::json($voter);
     }
   }
}



?>