<?php

namespace App\Events\Backend\Organisation;

use Illuminate\Queue\SerializesModels;

/**
 * Class OrganisationUpdated.
 */
class OrganisationUpdated
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
