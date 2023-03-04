<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombreMedico',
        'estadoMedico',
        'limiteCitas',
        'id_especialidad',
    ];

    public function estadoTexto()
    {
        return $this->estadoMedico ? 'Disponible' : 'No disponible';
    }
    
    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}
