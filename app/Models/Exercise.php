<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;

/**
 * Class Exercise
 * @package App\Models
 * @version October 23, 2019, 11:44 am UTC
 *
 * @property \App\Models\Category category
 * @property \App\Models\User user
 * @property integer user_id
 * @property integer category_id
 * @property string title
 * @property string ingredients
 * @property string make
 * @property integer fromMin
 * @property string video
 * @property string pics
 */
class Exercise extends Model
{
    use SoftDeletes;
    use Favoriteable;

    public $table = 'exercises';
    
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
        'user_id' => 'integer',
        'category_id' => 'integer',
        'title' => 'string',
        'ingredients' => 'string',
        'make' => 'string',
        'fromMin' => 'integer',
        'video' => 'string',
        'pics' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'ingredients' => 'required',
        'make' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function getExerciseIngredientsAttribute()
    {
        return explode("\r\n", $this->ingredients);
    }

    public function getExerciseMakeAttribute()
    {
        return explode("\r\n", $this->make);
    }
}
