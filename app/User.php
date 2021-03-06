<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use ChristianKuri\LaravelFavorite\Traits\Favoriteability;
use Laravelista\Comments\Commenter;

class User extends Authenticatable
{
    use Notifiable;
    use Favoriteability;
    use Commenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function assignments()
    {
        return $this->hasMany(\App\Models\Assignments::class);
    }
    public function blogs()
    {
        return $this->hasMany(\App\Models\Blogs::class);
    }
    public function exercises()
    {
        return $this->hasMany(\App\Models\Exercise::class);
    }
}
