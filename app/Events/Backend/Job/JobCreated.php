<?php

namespace App\Events\Backend\Job;

use Illuminate\Queue\SerializesModels;

/**
 * Class JobCreated.
 */
class JobCreated
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
