<?php

namespace App\Events;

use App\Models\License;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class LicenseExpiringSoon implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $license;

    public function __construct(License $license)
    {
        $this->license = $license;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.'.$this->license->project->id);
    }
}
