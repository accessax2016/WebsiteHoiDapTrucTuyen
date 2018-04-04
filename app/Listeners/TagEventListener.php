<?php

namespace App\Listeners;

use App\Events\TagEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Taggable;
use Carbon\Carbon;

class TagEventListener
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
     * @param  TagEvent  $event
     * @return void
     */
    public function handle(TagEvent $event)
    {
        if ($event->object->tags->count() > 0) {
            //Process list tag
            foreach ($event->object->tags as $taggable) {
                $taggable->pivot->delete();    // Delete old taggables
            }
        }
        
        //Process list tag
        $arrayTags = explode(',', $event->tags);  // Split data Ex: 1,2,3 => ["1", "2", "3"]
        foreach ($arrayTags as $tag) {
            // Create Model Taggable and set properties
            $taggable = new Taggable;
            $taggable->tag_id = $tag;
            $taggable->taggable_id = $event->object->id;
            $taggable->taggable_type = get_class($event->object);
            $taggable->created_at = Carbon::now();
            $taggable->updated_at = Carbon::now();
            $taggable->save();   // Save into database
        }   
    }
}
