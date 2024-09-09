<?php

namespace App\Jobs;

use App\Models\Tweet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessTweet implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */

    public $tweet;

    public function __construct($tweet)
    {
        $this->tweet = $tweet;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Tweet::create([
            'category_id' => $this->tweet['category_id'],
            'username' => $this->tweet['username'],
            'content' => $this->tweet['content'],
        ]);
    }
}
