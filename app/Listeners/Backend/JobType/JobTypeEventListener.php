<?php

namespace App\Listeners\Backend\JobType;

/**
 * Class JobTypeEventListener.
 */
class JobTypeEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->job_type->name;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->job_type->name;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->job_type->name;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\JobType\JobTypeCreated::class,
            'App\Listeners\Backend\JobType\JobTypeEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\JobType\JobTypeUpdated::class,
            'App\Listeners\Backend\JobType\JobTypeEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\JobType\JobTypeDeleted::class,
            'App\Listeners\Backend\JobType\JobTypeEventListener@onDeleted'
        );
    }
}
