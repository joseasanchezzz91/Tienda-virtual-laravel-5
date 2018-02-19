<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenItem extends Model
{
    protected $table ='orden_items';
    protected $fillable=['precio','cantidad','producto_id','orden_id'];
}
