<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use DB;
use App\Candidate;
use Excel;
use App\Imports\ImportVoter;
use Redirect,Response;
use Yajra\Datatables\Datatables;
class CandidateController extends Controller
{
    //
    public function storeCandidate(){
return Datatables::of(Candidate::select("id","name","visi_misi","photo"))
        ->addColumn('action', '
            <center>
             <a href="#"   data-id="{{ $id }}" data-original-title="Edit" class="edit btn btn-success edit-user"  data-toggle="modal" data-target="#ajax-crud-modal">
            <i class="fa fa-edit"></i>
              </a>
               
           <a href="#" class="btn btn-danger" onclick="deleteVoter({{$id}})"><i class="fa fa-trash"></i></a>
              </center> ')
        ->rawColumns(['action','visi_misi'])
        ->addIndexColumn()
        ->make(true);
    }

    public function index(){
      if(Auth::check()){
    	return view("candidate");
      }else{
        return redirect('/');
      }
    }

    public function createCandidate(Request $request){
        $file = $request->foto;
        if(isset($file)){
        $ext = $file->getClientOriginalExtension();
        $newName = rand(100000,1001238912).".".$ext;
       $gambar_path = public_path() . "/foto/";
       $file->move($gambar_path, $newName);
        $candidate_data = array(
		      'name' => $request->name,
		       'visi_misi'  => $request->visi_misi,
		       "photo" =>  url("/")."/foto/".$newName,
		   );
       }else {
       	$candidate_data = array(
		      'name' => $request->name,
		       'visi_misi'  => $request->visi_misi,
		   );
       }
		  
		  Candidate::create($candidate_data);
           return response::json($candidate_data);
    }

   public function  candidateDelete($id){
     if(Auth::user()){
     $candidate=Candidate::find($id);
      $url_image = explode("/", $candidate->photo);
     if(count($url_image)>0){
      $path = public_path()."/foto/".$url_image[count($url_image)-1];
        if(file_exists($path)){
          unlink($path);
       }
      }
       $candidate->delete();
       return Response::json($candidate);
    }
   }

    public function  candidateProfile($id){
      if(Auth::User()){
      $candidate=Candidate::find($id);
      return Response::json($candidate);
     }
   }

   public function  candidateEditProfile(Request $request){
     if(Auth::User()){
     $id = $request->user_id;
     $name = $request->name;
     $foto = $request->foto;
     $visi_misi= $request->visi_misi;
     $candidate=Candidate::find($id);
     $old_url=explode("/", $candidate->photo);;


    $candidate->name=$name;
    $candidate->visi_misi = $visi_misi;
    if(isset($foto)){
        $ext = $foto->getClientOriginalExtension();
        $newName = rand(100000,1001238912).".".$ext;
        $gambar_path = public_path()."/foto/";
        $foto->move($gambar_path, $newName);
        $candidate->photo= url("/foto/".$newName);
        $check = $candidate->save();
        if($check){
         $path = public_path()."/foto/".$old_url[count($old_url)-1];
           if(file_exists($path)){
           unlink($path);
        }
        }
        $candidate->save();
        return Response::json($candidate); 
    }    
    $candidate->save();         
    return Response::json($candidate);
     
    }
 }

}
