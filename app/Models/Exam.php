<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombreExamen',
        'clinica',
        'limiteCitas',
        'estadoExamen',
    ];

    public function estadoTexto()
    {
        return $this->estadoExamen ? 'Disponible' : 'No disponible';
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}
