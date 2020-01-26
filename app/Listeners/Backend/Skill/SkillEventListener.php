<?php

namespace App\Listeners\Backend\Skill;

/**
 * Class SkillEventListener.
 */
class SkillEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        $user    = auth()->user()->name;

        $newitem = $event->skill->name;

        \Log::info('User ' . $user . ' has created item ' . $newitem);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        $user           = auth()->user()->name;

        $updated_item   = $event->skill->name;

        \Log::info('User ' . $user . ' has updated item ' . $updated_item);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        $user           = auth()->user()->name;

        $deleted_item   = $event->skill->name;

        \Log::info('User ' . $user . ' has deleted item ' . $deleted_item);    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Skill\SkillCreated::class,
            'App\Listeners\Backend\Skill\SkillEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Skill\SkillUpdated::class,
            'App\Listeners\Backend\Skill\SkillEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Skill\SkillDeleted::class,
            'App\Listeners\Backend\Skill\SkillEventListener@onDeleted'
        );
    }
}
