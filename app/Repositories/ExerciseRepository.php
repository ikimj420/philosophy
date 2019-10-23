<?php

namespace App\Repositories;

use App\Models\Exercise;
use App\Repositories\BaseRepository;

/**
 * Class ExerciseRepository
 * @package App\Repositories
 * @version October 23, 2019, 11:44 am UTC
*/

class ExerciseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'category_id',
        'title',
        'ingredients',
        'make',
        'fromMin',
        'video',
        'pics'
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
        return Exercise::class;
    }
}
