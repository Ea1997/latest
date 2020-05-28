<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'item_id','prix','user_id','categorie_id','date_dispo','date_fin_dispo','premium','ville_id'
    ];
    public function item()
    {
    	return $this->belongsTo(Item::class);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

      public function order()
      {
      	return $this->hasMany(Order::class);
      }
      public function ville()
      {
          return $this->belongsTo(Ville::class);
      }
}
