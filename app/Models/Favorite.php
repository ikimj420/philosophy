<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Favorite
 * @package App\Models
 * @version October 23, 2019, 11:40 am UTC
 *
 * @property string favoriteable_type
 * @property integer favoriteable_id
 */
class Favorite extends Model
{
    public $table = 'favorites';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $guarded = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'favoriteable_type' => 'string',
        'favoriteable_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'favoriteable_type' => 'required',
        'favoriteable_id' => 'required'
    ];
}
