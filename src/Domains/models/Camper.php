<?php



class Camper
{
    protected $table = 'campers';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['nombre', 'edad', 'documento', 'tipo_documento', 'nivel_ingles', 'nivel_programacion'];
}








?>