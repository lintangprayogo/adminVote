<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Voter;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\Handler; 
class ImportVoter implements ToCollection
{
    

    public function collection(Collection $rows)
    {

      $count=0;
        foreach ($rows as $row) 
        {
          if($count!=0){
            try{
           Voter::updateOrCreate([
            'name'     => $row[0],
           'email'    => $row[1],
           'password' => Hash::make($row[2]),
            ]);
            } catch(\Exception $e){
                  
            }
           
          }
          $count++;
        }
    }

}
