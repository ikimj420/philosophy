<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\BaseRepository;

/**
 * Class TagRepository
 * @package App\Repositories
 * @version October 23, 2019, 11:21 am UTC
*/

class TagRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tag_id',
        'taggable_id',
        'taggable_type'
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
        return Tag::class;
    }
}
