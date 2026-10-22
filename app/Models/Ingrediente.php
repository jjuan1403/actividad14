<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ingrediente extends Model
{
    use HasFactory;

    protected $table = 'ingredientes';

    protected $fillable = [
        'nombre',
    ];

    public function recetaIngredientes(): HasMany
    {
        return $this->hasMany(RecetaIngrediente::class);
    }

    public function recetas(): BelongsToMany
    {
        return $this->belongsToMany(Receta::class, 'receta_ingredientes')
                    ->withPivot('cantidad', 'unidad_medida')
                    ->withTimestamps();
    }
}