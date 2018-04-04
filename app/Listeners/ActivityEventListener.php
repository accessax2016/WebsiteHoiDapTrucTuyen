<?php

namespace App\Listeners;

use App\Events\ActivityEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;
use App\Activity;

class ActivityEventListener
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
     * @param  ActivityEvent  $event
     * @return void
     */
    public function handle(ActivityEvent $event)
    {
        $activity = new Activity;
        $activity->user_id = Auth::id();
        $activity->user_related_id = $event->object->user->id;
        $activity->content = $event->activity;
        $activity->activitable_id = $event->object->id;
        $activity->activitable_type = get_class($event->object);
        $activity->save();
    }
}
