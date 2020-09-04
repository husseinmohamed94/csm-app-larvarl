<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     // $user = User::where('email',"hussein.mohamed010@gmail.com")->first();
     $user = DB::table('users')->where('email','husseinelmady5@gmail.com')->first();
        if(!$user){
             user::create([
                'name'=>'hussein',
                'email'=> 'husseinelmady5@gmail.com',
                'password' => Hash::make('123456'),
                'role'    => 'admin'
             ]);
        }
    }
}
