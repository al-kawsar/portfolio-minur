<?php

namespace App\Listeners;

use App\Events\ProfileCreated;
use App\Models\Contact;

class CreateContactFromProfile
{
    public function __construct()
    {
        //
    }

    public function handle(ProfileCreated $event)
    {
        $profile = $event->profile;

        // Tambahkan data ke tabel 'contact'
        Contact::create([
            'profile_id' => $profile->id,
        ]);
    }
}
