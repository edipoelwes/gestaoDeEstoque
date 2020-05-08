<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryHistory extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'company_id',
      'inventory_id',
      'user_id',
      'action',
    ];
}
