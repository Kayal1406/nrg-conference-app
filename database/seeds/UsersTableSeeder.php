<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
            'email' => 'kayalmanimohana@gmail.com',
            'password' => bcrypt('123456789'),
            'access_token' => '00D5C0000008iKT!ASAAQPVvNbf1.wg4E05Q9tGbLYbAZe2AyGgubJNDVtdrp_1r4_.bdRrM24MH7QMhipgYq2n3Br9TNkO7m.ra_LP8kSTVgm9r'
        ]);
    }
}
