<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LineaTiempo extends Model
{
    use HasFactory;

    protected $table = 'linea_tiempo';

    protected $fillable = [
        'ano',
        'titulo',
        'descripcion',
        'imagen',
    ];
}
