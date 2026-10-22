<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Receta;
use App\Models\Ingrediente;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecetaTest extends TestCase
{
    use RefreshDatabase;

    public function test_se_puede_instanciar_una_receta_con_ingredientes(): void
    {
        // 1. Instanciación del modelo Receta
        $receta = Receta::create([
            'titulo' => 'Gallo Pinto',
            'porciones' => 4,
            'instrucciones' => 'Freír olores, incorporar arroz y frijoles, mezclar con salsa Lizano.',
        ]);

        // 2. Instanciación de ingredientes
        $arroz = Ingrediente::create(['nombre' => 'Arroz cocido']);
        $frijoles = Ingrediente::create(['nombre' => 'Frijoles negros']);

        // 3. Asociación con atributos de la clase asociativa
        $receta->ingredientes()->attach($arroz->id, [
            'cantidad' => 2.0,
            'unidad_medida' => 'tazas',
        ]);

        $receta->ingredientes()->attach($frijoles->id, [
            'cantidad' => 1.5,
            'unidad_medida' => 'tazas',
        ]);

        // 4. Verificaciones
        $this->assertDatabaseHas('recetas', ['titulo' => 'Gallo Pinto']);
        $this->assertCount(2, $receta->ingredientes);
        $this->assertEquals(2.0, $receta->ingredientes->first()->pivot->cantidad);
        $this->assertEquals('tazas', $receta->ingredientes->first()->pivot->unidad_medida);
    }
}