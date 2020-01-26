<?php

namespace App\Events\Backend\Job;

use Illuminate\Queue\SerializesModels;

/**
 * Class JobDeleted.
 */
class JobDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $jobs;

    /**
     * @param $jobs
     */
    public function __construct($jobs)
    {
        $this->jobs = $jobs;
    }
}
