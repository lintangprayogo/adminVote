<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Candidate;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ScoreDetailExport implements FromCollection , WithHeadings,WithMapping
{   

    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
      $details=Candidate::
            join("scores","candidates.id","=","scores.candidate_id")
           ->join("users","users.id","=","scores.user_id")->select("users.name as user","candidates.name as candidate","scores.total as total","scores.leadership as leadership","scores.entrepreneurship as entrepreneurship",
               "scores.strategic as strategic","scores.manegement as manegement","scores.network as networking","scores.organization as organization","scores.personal as personal","scores.future as future","scores.digital as digital","scores.global as global")->get();

       return $details;
  }


 public function headings(): array
    {
        return [
            'Nama Kandidat ',
            'Nama Senat    ',
            'Leadership Of Change',
            'Entrepreneurship',
            'Strategic Orientation',
            'Action Manegement',
            'Networking',
            'Organization Climate Development',
            'Personal Value',
            'Future Orientation',
            'Digital Mastery',
            'Global Prespective',
            'Total Nilai   ',
           
            
        ];
    }

      public function map($detail): array
    {
        return [
            $detail->candidate,
            $detail->user,
            $detail->leadership,
            $detail->entrepreneurship,
            $detail->strategic,
            $detail->manegement,
            $detail->networking,
            $detail->organization,
            $detail->personal,
            $detail->future,
            $detail->total,
        ];
    }

}

