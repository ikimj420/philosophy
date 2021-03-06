<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Cviebrock\EloquentTaggable\Taggable;
use Laravelista\Comments\Commentable;

/**
 * Class Blog
 * @package App\Models
 * @version October 28, 2019, 10:50 am UTC
 *
 * @property \App\Models\Category category
 * @property \App\Models\User user
 * @property integer user_id
 * @property integer category_id
 * @property string title
 * @property string body
 * @property string code
 * @property string audio
 * @property string video
 * @property string pics
 */
class Blog extends Model
{
    use Taggable;
    use SoftDeletes;
    use Favoriteable;
    use Commentable;

    public $table = 'blogs';
    
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
        'body' => 'string',
        'code' => 'string',
        'audio' => 'string',
        'video' => 'string',
        'pics' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|min:4',
        'body' => 'required',
        'category_id' => 'required',

        'user_id' => 'sometimes',
        'code' => 'sometimes',
        'audio' => 'sometimes',
        'video' => 'sometimes',
        'tag' => 'sometimes',
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

    public function getBlogBodyAttribute()
    {
        return explode("\r\n", $this->body);
    }
}
