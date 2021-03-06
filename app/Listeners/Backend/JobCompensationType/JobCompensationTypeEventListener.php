<?php

namespace App\Listeners\Backend\JobCompensationType;

/**
 * Class JobCompensationTypeEventListener.
 */
class JobCompensationTypeEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->job_compensation_type->title;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->job_compensation_type->title;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->job_compensation_type->title;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\JobCompensationType\JobCompensationTypeCreated::class,
            'App\Listeners\Backend\JobCompensationType\JobCompensationTypeEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\JobCompensationType\JobCompensationTypeUpdated::class,
            'App\Listeners\Backend\JobCompensationType\JobCompensationTypeEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\JobCompensationType\JobCompensationTypeDeleted::class,
            'App\Listeners\Backend\JobCompensationType\JobCompensationTypeEventListener@onDeleted'
        );
    }
}
