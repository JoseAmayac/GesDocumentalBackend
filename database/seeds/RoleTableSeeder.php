<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'=>'administrador',
            'description' => 'Este rol se encargará de administrar varias cosas en el sistema'
        ]);
        Role::create([
            'name' => 'orientador',
            'description'  => 'Rol encargado de la subida de documentos nuevos al sistema'
        ]);
        Role::create([
            'name' => 'archivo',
            'description' => 'Rol encargado de enrutar los diferentes documentos que se suben al sistema'
        ]);
        Role::create([
            'name'=>'usuario',
            'description' => 'Rol que identifica un usuario normal del sistema'
        ]);
    }
}
