<?php

namespace App\Listeners\Backend\JobCategory;

/**
 * Class JobCategoryEventListener.
 */
class JobCategoryEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->job_category->name;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->job_category->name;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->job_category->name;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\JobCategory\JobCategoryCreated::class,
            'App\Listeners\Backend\JobCategory\JobCategoryEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\JobCategory\JobCategoryUpdated::class,
            'App\Listeners\Backend\JobCategory\JobCategoryEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\JobCategory\JobCategoryDeleted::class,
            'App\Listeners\Backend\JobCategory\JobCategoryEventListener@onDeleted'
        );
    }
}
