<?php

namespace App\Listeners;

use App\Events\RemoveReferencesEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemoveReferencesEventListener
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
     * @param  RemoveReferencesEvent  $event
     * @return void
     */
    public function handle(RemoveReferencesEvent $event)
    {
        $object = $event->object;
        // Delete taggables
        foreach ($object->tags as $taggable) {
            $taggable->pivot->delete();    // Delete old taggables
        }
        // Delete comments
        $comments = $object->comments;
        foreach($comments as $cmt){
            $cmt->delete();
        }
        if (get_class($object) == 'App\Question') {
            // Delete answers of question
            $answers = $object->answers;
            foreach ($answers as $ans) {
                $comments = $ans->comments;
                foreach ($comments as $cmt) {
                    $cmt->delete();  // Delete comments of question
                }
                $ans->delete(); // Delete answers of question
            }
        }
    }
}
