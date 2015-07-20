<?php

namespace App\Events;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Instrument;

class InstrumentUpdated extends Event implements ShouldBroadcast, ShouldQueue
{
    use SerializesModels;

    public $instrument;

    public function __construct(Instrument $instrument)
    {
        $this->instrument = $instrument;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['instrument.' . $this->instrument->nordnet_id];
    }
}
