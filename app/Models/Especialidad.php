<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    protected $table = 'especialidades';

    protected $fillable =   [
        'nombreEspecialidad',
        'clinica',
        'estadoEspecialidad',
    ];

    public function estadoTexto()
{
    return $this->estadoEspecialidad ? 'Disponible' : 'No disponible';
}

}
