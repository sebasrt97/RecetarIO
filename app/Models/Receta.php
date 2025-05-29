<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Receta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre',
        'descripcion',
        'instrucciones',
        'tiempo_preparacion',
        'ingredientes',
        'tiempo_coccion',
        'porciones',
        'dificultad',
        'imagen',
    ];

    #Para facilitar la búsqueda por nombre en la base de datos
    protected $casts = [
        'ingredientes' => 'array',
        'instrucciones' => 'array',
    ];

    #Para mejorar la búsqueda y la legibilidad de las URLs
    public function getRouteKeyName()
    {
        return 'nombre';
    }
    #muchos a uno (recetas a usuario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}