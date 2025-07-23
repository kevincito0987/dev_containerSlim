<?php

namespace App\Domains\Models;

use Illuminate\Database\Eloquent\Model;

class Camper extends Model
{
    protected $table = 'campers';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['nombre', 'edad', 'documento', 'tipo_documento', 'nivel_ingles', 'nivel_programacion'];
}








?>