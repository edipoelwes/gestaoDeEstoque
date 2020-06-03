<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
   use SoftDeletes;

   protected $fillable = [
      'company_id',
      'user_id',
      'name',
      'description',
      'status',
      'due_date',
      'value',
      'month_year',
   ];

   public function user ()
   {
      return $this->belongsTo(User::class);
   }

   public function setValueAttribute($value)
   {
      if (empty($value)) {
         $this->attributes['value'] = null;
      } else {
         $this->attributes['value'] = floatval($value);
      }
   }
}
