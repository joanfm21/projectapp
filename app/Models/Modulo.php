<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;
    public function ciclos(){
        return $this->hasMany(Ciclo::class, 'id');
    }
    public function users(){
        return $this->belongsTo(User::class, 'usuario_id');
    }
    public function ufs(){
        return $this->hasMany(Uf::class, 'modulo_id');
    }
    
   /* public function alumnos(){
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }*/
}
