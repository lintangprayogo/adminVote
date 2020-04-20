<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Score;
use App\Candidate;
use  App\Exports\ResultExport ;
use  App\Exports\ScoreDetailExport ;
use Excel;
use DB;
use Auth;
use Redirect;
class RekapController extends Controller
{
    //

    public function index(){
      if(Auth::check()){
          return view("rekap");
         }
         return redirect("/");
      }
    

    public function detail(){
      if(Auth::check()){
          return view("detail");
         }
         return redirect("/");
      }
    

    public function result(){

    }



   public function displayAvg(){
    $scores=Score::join('candidates',"candidates.id","=","scores.candidate_id")->
    select('name',DB::raw('avg(total)  as average'))->groupBy('candidate_id')->groupBy('name')->orderBy("average","desc")->get();
    $candidates=Candidate::get();
    $rank=1;
       foreach ($scores   as $score) {
         $score->rank=$rank;
         $rank++;
       }
    return Datatables::of($scores)->make(true);
   }



public function storeDetailScore(){
return Datatables::of(

            Candidate::join("scores","candidates.id","=","scores.candidate_id")
            ->join("users","users.id","=","scores.user_id")->select("users.name as user","candidates.name as candidate","scores.total as total","scores.leadership as leadership","scores.entrepreneurship as entrepreneurship",
               "scores.strategic as strategic","scores.manegement as manegement","scores.network as networking","scores.organization as organization","scores.personal as personal","scores.future as future","scores.digital as digital","scores.global as global")

           )->filterColumn('user', function($query, $keyword) {
                $query->orWhere('users.name', 'like', '%'. $keyword . '%');
            })
            ->filterColumn('candidate', function($query, $keyword) {
                $query->orWhere('candidates.name', 'like', '%'. $keyword . '%');
            })->addIndexColumn()->make(true);
    }



    public function export() 
    {
        return Excel::download(new ResultExport, 'hasil_penjurian.xlsx');
    }

     public function exportDetail() 
    {
        return Excel::download(new ScoreDetailExport, 'detail_hasil.xlsx');
    }

 
}
