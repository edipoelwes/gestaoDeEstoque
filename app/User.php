<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
   use Notifiable, SoftDeletes;

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'company_id',
      'name',
      'email',
      'password',

      'genre',
      'document',
      'document_secondary',
      'document_secondary_complement',
      'date_of_bird',
      'place_of_bird',
      'civil_status',
      'cover',

      'zipcode',
      'street',
      'number',
      'complement',
      'neighborhood',
      'state',
      'city',

      'telephone',
      'cell',

      'admin',

   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [
      'password', 'remember_token',
   ];

   /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
   protected $casts = [
      'email_verified_at' => 'datetime',
   ];

   public function companies()
   {
      return $this->hasMany(Company::class, 'user', 'id');
   }

   public function getUrlCoverAttribute()
   {
      if (!empty($this->cover)) {
         return Storage::url($this->cover);
      }

      return '';
   }

   public function setDocumentAttribute($value)
   {
      $this->attributes['document'] = $this->clearField($value);
   }

   public function getDocumentAttribute($value)
   {
      return substr($value, 0, 3) . '.' . substr($value, 3, 3) . '.' . substr($value, 6, 3) . '-' . substr($value, 9, 2);
   }

   public function setDateOfBirthAttribute($value)
   {
      $this->attributes['date_of_birth'] = $this->convertStringToDate($value);
   }

   public function getDateOfBirthAttribute($value)
   {
      return date('d/m/Y', strtotime($value));
   }

   public function setZipcodeAttribute($value)
   {
      $this->attributes['zipcode'] = $this->clearField($value);
   }

   public function setTelephoneAttribute($value)
   {
      $this->attributes['telephone'] = $this->clearField($value);
   }

   public function setCellAttribute($value)
   {
      $this->attributes['cell'] = $this->clearField($value);
   }

   public function setPasswordAttribute($value)
   {
      if (empty($value)) {
         unset($this->attributes['password']);
         return;
      }

      $this->attributes['password'] = bcrypt($value);
   }



   private function convertStringToDouble(?string $param)
   {
      if (empty($param)) {
         return null;
      }

      return str_replace(',', '.', str_replace('.', '', $param));
   }

   private function convertStringToDate(?string $param)
   {
      if (empty($param)) {
         return null;
      }

      list($day, $month, $year) = explode('/', $param);
      return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
   }

   private function clearField(?string $param)
   {
      if (empty($param)) {
         return '';
      }

      return str_replace(['.', '-', '/', '(', ')', ' '], '', $param);
   }
}
