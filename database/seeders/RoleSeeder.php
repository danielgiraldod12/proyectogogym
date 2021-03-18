<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Moderador']);
        $role3 = Role::create(['name' => 'Supervisor']);
        $role4 = Role::create(['name' => 'Usuario']);

        Permission::create(['name' => 'dashboard'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'dompdfuser'])->syncRoles([$role1,$role2,$role3]);

        Permission::create(['name' => 'asistencia'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'createasistencia'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'destroyasistencia'])->syncRoles([$role1,$role2]);

        Permission::create(['name' => 'users'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'create'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'crear'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'update'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'destroy'])->syncRoles([$role1,$role2]);

        Permission::create(['name' => 'record_num'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'creatern'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'crearrn'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'editrn'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'updatern'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'destroyrn'])->syncRoles([$role1],$role2);

        Permission::create(['name' => 'programs'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'createprog'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'crearprog'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'editprog'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'updateprog'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'destroyprog'])->syncRoles([$role1,$role2]);

        Permission::create(['name' => 'events'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'createevents'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'crearevents'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'editevents'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'updateevents'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'destroyevents'])->syncRoles([$role1,$role2]);

        Permission::create(['name' => 'roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'editroles'])->syncRoles([$role1]);
        Permission::create(['name' => 'updateroles'])->syncRoles([$role1]);

        Permission::create(['name' => 'dashboard.profile'])->syncRoles([$role1,$role2,$role3]);

        Permission::create(['name' => 'chart.first'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'chart.second'])->syncRoles([$role1,$role2,$role3]);
    }
}
