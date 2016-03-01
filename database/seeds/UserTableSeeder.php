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
        //
        DB::table('users')->insert([
            'name' => 'Nguyễn Minh Đức',
            'email' => 'ducnm_57@vnu.edu.vn',
            'password' => bcrypt('12345678'),
            'user_role_id' => 1,
        ]);
    }
}
