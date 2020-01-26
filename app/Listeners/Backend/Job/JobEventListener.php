<?php

namespace App\Listeners\Backend\Job;

/**
 * Class JobEventListener.
 */
class JobEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->job->name;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->job->name;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->job->name;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Job\JobCreated::class,
            'App\Listeners\Backend\Job\JobEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Job\JobUpdated::class,
            'App\Listeners\Backend\Job\JobEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Job\JobDeleted::class,
            'App\Listeners\Backend\Job\JobEventListener@onDeleted'
        );
    }
}
