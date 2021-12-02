<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calificacion extends Model
{
    use HasFactory;
    protected $table="calificaciones";
    protected $fillable =[
        'firstcal',
        'secondcal',
        'thirdcal',
        'fourcal',
        'comentario',
        'usuario_id',
    ];
    public $timestamps=false;
}
