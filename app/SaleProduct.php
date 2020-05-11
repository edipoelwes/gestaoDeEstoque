<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleProduct extends Model
{
   use SoftDeletes;

   protected $fillable = [
      'company_id',
      'sale_id',
      'inventory_id',
      'amount',
      'price',
      'sub_total',
   ];

   public function inventory ()
   {
      return $this->belongsTo(Inventory::class);
   }
}
