<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Contact::create([
            'akun_instagram' => "rhn ig",
            'akun_facebook' => "rehan fb",
            'akun_youtube' => "rehan yt",
            'akun_linkedin' => "rehan linkdin",
            'akun_twitter' => "rehan tw",
            'akun_github' => "rehan git",
        ]);
    }
}
