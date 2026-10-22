<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Receta extends Model
{
    use HasFactory;

    protected $table = 'recetas';

    protected $fillable = [
        'titulo',
        'porciones',
        'instrucciones',
    ];

    public function recetaIngredientes(): HasMany
    {
        return $this->hasMany(RecetaIngrediente::class);
    }

    public function ingredientes(): BelongsToMany
    {
        return $this->belongsToMany(Ingrediente::class, 'receta_ingredientes')
                    ->withPivot('cantidad', 'unidad_medida')
                    ->withTimestamps();
    }
}