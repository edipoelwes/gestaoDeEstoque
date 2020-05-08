<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
   use SoftDeletes;

   protected $fillable = [
      'company_id',
      'name',
      'document',
      'phone',
      'phone_secondary',

      'zipcode',
      'street',
      'number',
      'complement',
      'neighborhood',
      'state',
      'city',
   ];

   public function setDocumentAttribute($value)
   {
      $this->attributes['document'] = $this->clearField($value);
   }

   public function setPhoneAttribute($value)
   {
      $this->attributes['phone'] = $this->clearField($value);
   }

   public function setPhoneSecondaryAttribute($value)
   {
      $this->attributes['phone_secondary'] = $this->clearField($value);
   }

   public function setZipcodeAttribute($value)
   {
      $this->attributes['zipcode'] = $this->clearField($value);
   }

   private function clearField(?string $param)
   {
      if (empty($param)) {
         return '';
      }

      return str_replace(['.', '-', '/', '(', ')', ' '], '', $param);
   }
}
