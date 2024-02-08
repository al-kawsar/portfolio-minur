<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProfileCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $profile;

    public function __construct($profile)
    {
        $this->profile = $profile;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
