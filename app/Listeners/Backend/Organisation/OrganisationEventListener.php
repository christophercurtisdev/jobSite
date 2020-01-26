<?php

namespace App\Listeners\Backend\Organisation;

/**
 * Class OrganisationEventListener.
 */
class OrganisationEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->organisation->name;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->organisation->name;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->organisation->name;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Organisation\OrganisationCreated::class,
            'App\Listeners\Backend\Organisation\OrganisationEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Organisation\OrganisationUpdated::class,
            'App\Listeners\Backend\Organisation\OrganisationEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Organisation\OrganisationDeleted::class,
            'App\Listeners\Backend\Organisation\OrganisationEventListener@onDeleted'
        );
    }
}
