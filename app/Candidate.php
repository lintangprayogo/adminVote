<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    //
     protected $fillable = [
        'name', 'visi_misi', 'photo',
    ];
}
