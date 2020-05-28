<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','prenom','telephone', 'email','adresse', 'password',
    ];

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
    protected static function boot()
    {
      parent::boot();
      static::created(
        function($user){
          $user->profile()->create([
              'image'=>'profile/none.jpg'
          ]);


        }
      );
    }


    public function profile()
    {
      return $this->hasOne(Profile::class);
    }
    public function item()
    {
    return $this->hasMany(Item::class)->orderBy('created_at','DESC');

    }
    public function post()
    {
    return $this->hasMany(Post::class)->orderBy('created_at','DESC');

    }
    public function order()
    {
    return $this->hasMany(Order::class);

    }
    public function comments()
    {
    return $this->hasMany(Comment::class);

    }
    public function commentsprofile()
    {
    return $this->hasMany(CommentUser::class);

    }
}
