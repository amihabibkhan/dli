<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
           ['role' => 'Admin'],
           ['role' => 'General']
        ]);

        // options insert
        DB::table('options')->insert([
           ['title' => 'site_title'],
           ['title' => 'slogan'],
           ['title' => 'logo'],
           ['title' => 'icon'],
           ['title' => 'banner'],
           ['title' => 'description'],
           ['title' => 'address'],
           ['title' => 'email_1'],
           ['title' => 'email_2'],
           ['title' => 'phone_1'],
           ['title' => 'phone_2']
        ]);
    }
}
