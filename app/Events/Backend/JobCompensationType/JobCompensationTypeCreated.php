<?php

namespace App\Events\Backend\JobCompensationType;

use Illuminate\Queue\SerializesModels;

/**
 * Class JobCompensationTypeCreated.
 */
class JobCompensationTypeCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $job_compensation_types;

    /**
     * @param $job_compensation_types
     */
    public function __construct($job_compensation_types)
    {
        $this->job_compensation_types = $job_compensation_types;
    }
}
