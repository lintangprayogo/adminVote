<?php

use Illuminate\Database\Seeder;
use App\User;
class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      User::create(['name'=>"adminvote",
                    'email'=>"adminvote@gmail.com",
                    "password"=>Hash::make("12345678"),
                    "remember_token"=>str_random(10)
         ]);

    }
}
