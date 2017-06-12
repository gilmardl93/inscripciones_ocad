<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(CatalogoTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(EvaluacionTableSeeder::class);
        $this->call(AulaTableSeeder::class);
        $this->call(SecuenciaTableSeeder::class);
        $this->call(ModalidadTableSeeder::class);
        $this->call(ServicioTableSeeder::class);
        $this->call(CronogramaTableSeeder::class);
        $this->call(UbigeoTableSeeder::class);
        $this->call(PaisTableSeeder::class);
        $this->call(FacultadTableSeeder::class);
        $this->call(EspecialidadTableSeeder::class);

        Model::reguard();
    }
}
