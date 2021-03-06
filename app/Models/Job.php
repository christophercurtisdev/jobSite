<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Traits\Attribute\JobAttribute;

class Job extends Model
{
    use JobAttribute,
        SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'compensation',
        'extra_attributes',
        'job_compensation_type_id',
        'job_type_id',
        'job_category_id',
        'job_sub_category_id',
    ];
}
