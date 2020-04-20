<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Score;
use App\Candidate;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class ResultExport implements FromCollection , WithHeadings,WithMapping
{   

    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
  $scores=Score::join('candidates',"candidates.id","=","scores.candidate_id")->
    select('name',DB::raw('round(avg(total))  as average'))->groupBy('candidate_id')->groupBy('name')->orderBy("average","desc")->get();
    $rank=1;
   foreach ($scores   as $score) {
     $score->ranking=$rank;
     $rank++;
   }
   return $scores;
  }


 public function headings(): array
    {
        return [
            'Rank',
            'Name',
            'Total Nilai'
            
        ];
    }

      public function map($score): array
    {
        return [
            $score->ranking,
            $score->name,
            $score->average,
        ];
    }

}
