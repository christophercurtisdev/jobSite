<?php

namespace App\Events\Backend\JobCategory;

use Illuminate\Queue\SerializesModels;

/**
 * Class JobCategoryUpdated.
 */
class JobCategoryUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $job_categories;

    /**
     * @param $job_categories
     */
    public function __construct($job_categories)
    {
        $this->job_categories = $job_categories;
    }
}
