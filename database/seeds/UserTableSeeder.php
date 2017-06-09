<?php

use App\Models\Catalogo;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Catalogo::Table('ROLES')->where('codigo','root')->first();
        factory(App\User::class)->create([
            'dni' => 'lmayta',
            'password' => '321654987',
            'idrole' =>$role->id,
            'menu' => 'menu.sider-admin',
            'email' => 'lmayta@admisionuni.edu.pe',
            ]);
        factory(App\User::class)->create([
            'dni' => 'gmoreno',
            'password' => 'gmoreno',
            'idrole' =>$role->id,
            'menu' => 'menu.sider-admin',
            'email' => 'gmoreno@admisionuni.edu.pe',
            ]);
        $role = Catalogo::Table('ROLES')->where('codigo','jefe')->first();
        factory(App\User::class)->create([
            'dni' => 'cponce',
            'password' => 'cponce',
            'idrole' =>$role->id,
            'menu' => 'menu.sider-admin',
            'email' => 'cponce@admisionuni.edu.pe',
            ]);
        factory(App\User::class)->create([
            'dni' => 'nfukuda',
            'password' => 'nfukuda',
            'idrole' =>$role->id,
            'menu' => 'menu.sider-admin',
            'email' => 'nfukuda@admisionuni.edu.pe',
            ]);
    }
}
