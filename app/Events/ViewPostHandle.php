<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;
use Illuminate\Session\Store;

class ViewPostHandle
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    public function handle(Post $post)
    {
        if (!$this->isPostViewed($post))
	    {
	        $post->increment('views');
	        $this->storePost($post);
	    }
    }
    private function isPostViewed($post)
	{
	    $viewed = $this->session->get('viewed_posts', []);

	    return array_key_exists($post->id, $viewed);
	}

	private function storePost($post)
	{
	    $key = 'viewed_posts.' . $post->id;

	    $this->session->put($key, time());
	}
}
