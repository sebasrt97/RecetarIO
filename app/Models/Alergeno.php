<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Ingrediente;

class Alergeno extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];

    public function ingredientes(): BelongsToMany
    {
        return $this->belongsToMany(Ingrediente::class, 'ingrediente_alergeno', 'alergeno_id', 'ingrediente_id');
    }
}
