<?php

namespace App\Listeners\Backend\JobSubCategory;

/**
 * Class JobSubCategoryEventListener.
 */
class JobSubCategoryEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->job_sub_category->name;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->job_sub_category->name;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->job_sub_category->name;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\JobSubCategory\JobSubCategoryCreated::class,
            'App\Listeners\Backend\JobSubCategory\JobSubCategoryEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\JobSubCategory\JobSubCategoryUpdated::class,
            'App\Listeners\Backend\JobSubCategory\JobSubCategoryEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\JobSubCategory\JobSubCategoryDeleted::class,
            'App\Listeners\Backend\JobSubCategory\JobSubCategoryEventListener@onDeleted'
        );
    }
}
