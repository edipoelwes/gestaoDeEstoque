<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
   const TYPES = [
      ['id' => 0, 'name' => 'Boleto Bancario'],
      ['id' => 1, 'name' => 'Cartão de Credito'],
      ['id' => 2, 'name' => 'Avísta'],
   ];

   public static function all($columns = [])
   {
      return array_obj(self::TYPES);
   }

   public static function find($type)
   {
      return collect(self::all())
         ->first(fn ($value) => $value == $type);
   }
}
