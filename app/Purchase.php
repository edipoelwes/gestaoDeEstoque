<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
   use SoftDeletes;

   protected $fillable = [
      'company_id',
      'user_id',
      'status',
      'payment_method',
      'total',
      'obs',
      'provider',
   ];

   public function user()
   {
      return $this->belongsTo(User::class);
   }
}
