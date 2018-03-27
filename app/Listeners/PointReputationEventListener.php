<?php

namespace App\Listeners;

use App\Events\PointReputationEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;

class PointReputationEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PointReputationEvent  $event
     * @return void
     */
    public function handle(PointReputationEvent $event)
    {
        $user = Auth::user();
        if ($event->type) {
            $user->point_reputation += $event->point;
            $user->save();
        }
        else {
            $user->point_reputation -= $event->point;
            $user->save();
        }
        
    }
}
