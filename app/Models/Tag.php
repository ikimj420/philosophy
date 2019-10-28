<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tag
 * @package App\Models
 * @version October 23, 2019, 11:21 am UTC
 *
 * @property integer tag_id
 * @property integer taggable_id
 * @property string taggable_type
 */
class Tag extends Model
{
    use SoftDeletes;

    public $table = 'taggables';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $guarded = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'tag_id' => 'integer',
        'taggable_id' => 'integer',
        'taggable_type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tag_id' => 'required',
        'taggable_id' => 'required',
        'taggable_type' => 'required'
    ];

    
}
