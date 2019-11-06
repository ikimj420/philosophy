<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @package App\Models
 * @version October 23, 2019, 11:09 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection blogs
 * @property \Illuminate\Database\Eloquent\Collection exercises
 * @property string name
 * @property string desc
 * @property string pics
 */
class Category extends Model
{
    use SoftDeletes;

    public $table = 'categories';
    
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
        'id' => 'integer',
        'name' => 'string',
        'desc' => 'string',
        'pics' => 'string',
        'sucCategory' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'subCategory' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function blogs()
    {
        return $this->hasMany(\App\Models\Blog::class, 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function exercises()
    {
        return $this->hasMany(\App\Models\Exercise::class, 'category_id');
    }
}
