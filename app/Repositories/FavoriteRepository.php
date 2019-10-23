<?php

namespace App\Repositories;

use App\Models\Favorite;
use App\Repositories\BaseRepository;

/**
 * Class FavoriteRepository
 * @package App\Repositories
 * @version October 23, 2019, 11:40 am UTC
*/

class FavoriteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'favoriteable_type',
        'favoriteable_id'
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
        return Favorite::class;
    }
}
