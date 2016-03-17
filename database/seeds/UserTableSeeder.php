<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@vnu.edu.vn',
            'password' => bcrypt('admin'),
            'user_role_id' => 1,
        ]);
    }
}
