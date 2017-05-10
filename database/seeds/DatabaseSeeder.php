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

        Model::reguard();
    }
}
