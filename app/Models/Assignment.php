<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Assignment
 * @package App\Models
 * @version October 23, 2019, 11:13 am UTC
 *
 * @property \App\Models\User user
 * @property integer user_id
 * @property string body
 * @property string date
 * @property boolean isDone
 */
class Assignment extends Model
{
    use SoftDeletes;

    public $table = 'assignments';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'body',
        'date',
        'isDone'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'body' => 'string',
        'date' => 'date',
        'isDone' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'body' => 'required',
        'isDone' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
