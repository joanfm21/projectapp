<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    public function ufs(){
        return $this->belongsToMany(Uf::class,'alumno_ufs')->withPivot('cualificacion')->withTimestamps();
    }
    
    public function modulos(){
        return $this->hasMany(Modulo::class, 'id');
    }
}
