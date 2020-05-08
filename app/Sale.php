<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'company_id',
    'user_id',
    'client_id',
    'total_price',
    'status'
  ];


  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function client()
  {
    return $this->belongsTo(Client::class);
  }

  public function setTotalPriceAttribute($value)
  {
    if (empty($value)) {
      $this->attributes['total_price'] = null;
    } else {
      $this->attributes['total_price'] = floatval($this->convertStringToDouble($value));
    }
  }

  public function getTotalPriceAttribute($value)
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
