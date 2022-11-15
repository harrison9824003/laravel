<?php

namespace App\Events;

use App\Models\Shop\Product;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeleteProduct
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $product;
    public $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Authenticatable $user, Product $product)
    {
        $this->product = $product;
        $this->user = $user;
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
}
