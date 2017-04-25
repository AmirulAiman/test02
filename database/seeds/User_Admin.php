<?php

use Illuminate\Database\Seeder;

use App\User;

use Carbon\Carbon;

class User_Admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->id = 0;
        $user->email = 'admin@gmail.com';
        $user->password = bcrypt('12345');
        $user->user_type = 0;
        $user->last_login = Carbon::now();
        $user->save();

    }
}
