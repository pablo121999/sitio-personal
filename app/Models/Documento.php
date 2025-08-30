<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $table = 'documentos';

    protected $fillable = [
        'nombre',
        'tamano',
        'tipo',
        'documento',
        'data',
    ];

    protected $casts = [
        'data' => 'array', // para trabajar el JSON como array en PHP
    ];
}
