<?php

namespace App\Events\Backend\JobType;

use Illuminate\Queue\SerializesModels;

/**
 * Class JobTypeCreated.
 */
class JobTypeCreated
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
