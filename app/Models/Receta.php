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
       // 'ingredientes' => 'array',
     //   'instrucciones' => 'array',
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

    public function getInstruccionesAttribute($value)
    {
    // Intenta decodificar el valor. Si falla o no es JSON, devuelve un array vacío.
    $decoded = json_decode($value, true);
    return is_array($decoded) ? $decoded : [];
    }

    public function getIngredientesAttribute($value)
    {
        // Intenta decodificar el valor. Si falla o no es JSON, devuelve un array vacío.
        $decoded = json_decode($value, true);
        return is_array($decoded) ? $decoded : [];
    }
}