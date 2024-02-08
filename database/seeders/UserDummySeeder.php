<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;

class UserDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = new Profile();
        $profile->nama = "Muhammad Irfan Nur, A.Md., S.Pd";
        $profile->bio = "Tertarik untuk belajar hal baru dan mengembangkan ilmu yang telah dipelajari";
        $profile->tanggal_lahir = "13 Juni 1997";
        $profile->alamat = "BTN Andi Tonro Gowa B. 12 No. 7";
        $profile->email = "irfannur48@gmail.com";
        $profile->nomor_hp = "+62 811 499 7500";
        $profile->gambar = "belum ada.jpg";
        $profile->save();
    }
}
