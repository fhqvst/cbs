<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ViewInstrument extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $instrument_id;
    public $market_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($instrument_id, $market_id)
    {
        $this->instrument_id = $instrument_id;
        $this->market_id = $market_id;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['global'];
    }
}
