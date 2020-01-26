<?php

namespace App\Events\Backend\JobType;

use Illuminate\Queue\SerializesModels;

/**
 * Class JobTypeDeleted.
 */
class JobTypeDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $job_types;

    /**
     * @param $job_types
     */
    public function __construct($job_types)
    {
        $this->job_types = $job_types;
    }
}
