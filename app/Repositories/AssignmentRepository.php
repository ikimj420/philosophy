<?php

namespace App\Repositories;

use App\Models\Assignment;
use App\Repositories\BaseRepository;

/**
 * Class AssignmentRepository
 * @package App\Repositories
 * @version October 23, 2019, 11:13 am UTC
*/

class AssignmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'body',
        'date',
        'isDone'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Assignment::class;
    }
}
