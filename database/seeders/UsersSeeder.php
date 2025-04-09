<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(['name' => 'admin', 'email' => 'admin@sareea.com', 'password' => bcrypt('secret')]);

        $user->roles()->attach(1);
    }
}
