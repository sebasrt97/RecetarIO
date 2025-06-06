<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Ingrediente;

class Receta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre',
        'descripcion',
        'instrucciones',
        'tiempo_preparacion',
        'tiempo_coccion',
        'porciones',
        'dificultad',
        'margen_beneficio',
        'imagen',
    ];

    protected $casts = [
        'instrucciones' => 'array', // Esto permite que las instrucciones se manejen como un array en lugar de una cadena JSON
    ];

    #Relaciones
     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

     public function ingredientes(): BelongsToMany
    {
        return $this->belongsToMany(Ingrediente::class, 'receta_ingrediente')
        ->withPivot('cantidad_bruta', 'unidad_receta_medida');    
    }

    #Para mejorar la búsqueda y la legibilidad de las URLs
    public function getRouteKeyName():string
    {
        return 'nombre';
    }  

   
    # funciones publicas para obtener los ingredientes y sus cantidades

    public function getCostebrutoTotal():float
    {
        $total = 0;
        foreach ($this->ingredientes as $ingrediente) {
            $cantidadBruta = $ingrediente->pivot->cantidad_bruta;
            $precio = $ingrediente->precio;
            $total += $cantidadBruta * $precio;
        }
        return $total;
    }

    public function getCosteNetoTotal()
    {
       $total=0;
       foreach($this->ingredientes as $ingrediente) {
            $cantidadBruta = $ingrediente->pivot->cantidad_bruta;
            $merma = $ingrediente->porcentaje_merma;
            $cantidadNeta = $cantidadBruta * (1 - $merma / 100);
            $precioUnidad = $ingrediente->precio; 
            $total += $cantidadNeta * $precioUnidad;
        }
        return $total;
    }

    public function getCostePorPorcion(): float
    {
        if($this->porciones > 0) {
            return $this->getCosteNetoTotal() / $this->porciones;
        } 

        return 0.0;
    }

    public function getPrecioVentaPorPorcion(): float
    {
        $costePorPorcion = $this->getCostePorPorcion();
        $margenBeneficio = $this->margen_beneficio / 100; // Convertir a decimal
        return $costePorPorcion * (1 + $margenBeneficio);
    }

}