<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseProduct extends Model
{
   use SoftDeletes;

   protected $fillable = [
      'company_id',
      'purchase_id',
      'inventory_id',
      'amount',
      'sub_total',
   ];

   public function inventory ()
   {
      return $this->belongsTo(Inventory::class);
   }
}
