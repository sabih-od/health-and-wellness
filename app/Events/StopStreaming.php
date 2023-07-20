<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StopStreaming implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $session_id;
    public $message;

    /**
     * Create a new event instance.
     *
     * @param  string  $message
     * @return void
     */

    public function __construct($session_id, string $message)
    {
        $this->session_id = $session_id;
        $this->message = $message;

    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */

    public function broadcastOn()
    {
        return new PrivateChannel('streaming-channel.' . $this->session_id);
    }

    /**
     * Get the broadcast event name.
     *
     * @return string
     */
    public function broadcastAs() : string
    {
        return 'StopStreaming';

    }
}
