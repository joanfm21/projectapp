<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uf extends Model
{
    use HasFactory;

    public function modulos(){
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }

    public function alumnos(){
        return $this->belongsToMany(Alumno::class, 'alumno_ufs')->withPivot('cualificacion')->withTimestamps();
    }
}
