<?php

namespace App\Events\Backend\Organisation;

use Illuminate\Queue\SerializesModels;

/**
 * Class OrganisationDeleted.
 */
class OrganisationDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $organisations;

    /**
     * @param $organisations
     */
    public function __construct($organisations)
    {
        $this->organisations = $organisations;
    }
}
