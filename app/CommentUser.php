<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentUser extends Model
{
    public function profile()
    {
    	return $this->belongsTo(Profile::class);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
