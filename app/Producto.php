<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre','slug','descripcion','extracto','precio','imagen','visible','categoria_id'
    ];

}
