<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingrediente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'precio',
        'unidad_receta_medida',
        'porcentaje_merma',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'porcentaje_merma' => 'decimal:2',
    ];

    public function recetas(): BelongsToMany
    {
        return $this->belongsToMany(Receta::class, 'receta_ingrediente')
            ->withPivot('cantidad_bruta', 'unidad_receta_medida');
    }

    public function alergenos(): BelongsToMany
    {
        return $this->belongsToMany(Alergeno::class, 'ingrediente_alergeno', 'ingrediente_id', 'alergeno_id');
    }
}
