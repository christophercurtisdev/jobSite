<?php

namespace App\Events\Backend\JobSubCategory;

use Illuminate\Queue\SerializesModels;

/**
 * Class JobSubCategoryDeleted.
 */
class JobSubCategoryDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $job_sub_categories;

    /**
     * @param $job_sub_categories
     */
    public function __construct($job_sub_categories)
    {
        $this->job_sub_categories = $job_sub_categories;
    }
}
