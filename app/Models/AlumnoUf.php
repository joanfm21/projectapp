<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoUf extends Model
{
    use HasFactory;
    protected $fillable = ['cualificacion','uf_id','alumno_id'];
}
