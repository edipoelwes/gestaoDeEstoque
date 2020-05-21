<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
   const TYPES = [
      ['id' => 1, 'name' => 'Confirmado'],
      ['id' => 2, 'name' => 'Cancelado'],
      ['id' => 3, 'name' => 'Pendente'],
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
