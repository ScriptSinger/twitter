<?php

namespace App\Events;

use App\Models\Tweet;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TweetCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $tweet;

    public function __construct($tweet)
    {
        $this->tweet = $tweet;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('tweets'),
        ];
    }

    public function broadcastWith()
    {
        return [
            'tweet' => [
                'id' => $this->tweet['id'],
                'username' => $this->tweet['username'],
                'content' => $this->tweet['content'],
                'created_at' => $this->tweet['created_at'],
                'category' => $this->tweet['category'], // Если требуется категория
            ],
        ];
    }
}
