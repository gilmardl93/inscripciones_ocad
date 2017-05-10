<?php

use App\Models\Secuencia;
use Illuminate\Database\Seeder;

class SecuenciaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Secuencia::create(['nombre' => 'canal_i']);
        Secuencia::create(['nombre' => 'canal_ii']);
        Secuencia::create(['nombre' => 'canal_iii']);
        Secuencia::create(['nombre' => 'canal_iv']);
        Secuencia::create(['nombre' => 'canal_v']);
        Secuencia::create(['nombre' => 'canal_vi']);
        Secuencia::create(['nombre' => 'canal_vii']);

    }
}
