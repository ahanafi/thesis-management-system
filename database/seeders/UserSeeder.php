<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Academic staff
        $user = new User();
        $user->full_name = "Administrator";
        $user->username = "hanafi";
        $user->email = "ahanafi.id@gmail.com";
        $user->password = bcrypt("12345679");
        $user->level = "ACADEMIC_STAFF";
        $user->save();
    }
}
