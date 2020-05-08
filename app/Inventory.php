<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
   use SoftDeletes;

   protected $fillable = [
      'company_id',
      'name',
      'price',
      'amount',
      'min_amount',
   ];

   public function add()
   {
   }

   public function setPriceAttribute($value)
   {
      if (empty($value)) {
         $this->attributes['price'] = null;
      } else {
         $this->attributes['price'] = floatval($this->convertStringToDouble($value));
      }
   }

   public function getPriceAttribute($value)
   {
      return number_format($value, 2, ',', '.');
   }

   private function convertStringToDouble(?string $param)
   {
      if (empty($param)) {
         return null;
      }

      return str_replace(',', '.', str_replace('.', '', $param));
   }
}
