<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecetaIngrediente extends Pivot
{
    protected $table = 'receta_ingredientes';

    protected $fillable = [
        'receta_id',
        'ingrediente_id',
        'cantidad',
        'unidad_medida',
    ];

    public function receta(): BelongsTo
    {
        return $this->belongsTo(Receta::class);
    }

    public function ingrediente(): BelongsTo
    {
        return $this->belongsTo(Ingrediente::class);
    }
}