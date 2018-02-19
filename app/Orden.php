<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table='ordens';

    protected $fillable = ['subtotal','envio','user_id'];
}
