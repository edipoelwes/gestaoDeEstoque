<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Inventory extends Model
{
   use SoftDeletes;

   protected $fillable = [
      'company_id',
      'category_id',
      'name',
      'price',
      'amount',
      'min_amount',
   ];


   public function searchProductByName($id, $company_id)
   {

      // $product = DB::table('inventories')
      //    ->select('id', 'name')
      //    ->where('name', 'like', '%'. $name . '%')
      //    ->get();

      $product = Inventory::where([['id', $id], ['company_id', $company_id] ])->first();

      $product['link'] = url('https://localhost/projects/b7web/sonhosDeNinar/public/inventories/'.$product->id.'/edit');

      return $product;
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
      return $value;
   }

   private function convertStringToDouble(?string $param)
   {
      if (empty($param)) {
         return null;
      }

      return str_replace(',', '.', str_replace('.', '', $param));
   }
}
