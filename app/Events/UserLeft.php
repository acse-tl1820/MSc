<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserLeft implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $user;
    public $roomId;

    public function __construct($user, $roomId)
    {
        $this->user = $user;
        $this->roomId = $roomId;
    }
    public function broadcastOn()
    {
        return new PresenceChannel("chatroom.{$this->roomId}");
    }

    public function broadcastWith()
    {
        return ['id' => $this->user->id, 'name' => $this->user->name];
    }
}
