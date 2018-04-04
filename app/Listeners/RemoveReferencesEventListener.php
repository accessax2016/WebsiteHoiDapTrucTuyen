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
        switch (get_class($object)) {
            case 'App\Question':
                $this->deleteAnswer($object);
                $this->deleteComments($object);
                $this->deleteTaggables($object);
                break;
            case 'App\Documentation':
                $this->deleteComments($object);
                $this->deleteTaggables($object);
                break;
            case 'App\Answer':
                $this->deleteComments($object);
                break;
            default:
                # code...
                break;
        }
    }

    public function deleteTaggables($object)
    {
        // Delete taggables
        foreach ($object->tags as $taggable) {
            $taggable->pivot->delete();    // Delete old taggables
        }
    }

    public function deleteComments($object)
    {
        // Delete comments
        $comments = $object->comments;
        foreach($comments as $cmt){
            $cmt->delete();
        }
    }

    public function deleteAnswer($object)
    {
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
