<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConnectionHandler implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $type, $id; 

    // @ params: 
    // @ type -> connect : disconnect
    // @ id -> Auth::user()->id
    public function __construct($type, $id)
    {   
        $this->type = $type; 
        $this->id = $id; 
    }

    public function broadcastOn()
    {
        return new Channel('Connection');
    }
}
