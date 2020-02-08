<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    //
    protected $table = 'categorias';
    protected $fillable = ['nombre','descripcion','condicion','created_at','updated_at'];
    
}
