<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');

        /*\Illuminate\Support\Facades\DB::statement("SET FOREIGN_KEY_CHECKS = 0");

        \App\User::truncate();*/

        /*\App\Post::truncate();
        \App\Comment::truncate();*/

        /*factory(\App\User::class,10)->create();*/

        /*
        factory(\App\Post::class,50)->create();
        factory(\App\Comment::class,100)->create();*/

        /*\Illuminate\Support\Facades\DB::statement("SET FOREIGN_KEY_CHECKS = 1");*/


        $this->call(UserTableSeeder::class);


    }
}
