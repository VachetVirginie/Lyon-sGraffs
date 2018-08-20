<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Models\ { User, Category };
use App\Models\Image;


class Point extends Model
{
  public function user()
  {
      return $this->belongsTo(User::class);
  }
  
  public function image()
  {
      //aller hasOne / retour belongsTo
      return $this->hasOne(Image::class);
  }
}
