<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{

    private const AdminPermissions = [
        'create_topic',
        'update_topic',
        'delete_topic',
        'show_topic',
        'make_consult',
        'create_category',
        'delete_category',
        'show_category'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);

        foreach (self::AdminPermissions as $permission) {
            Permission::create(['name' => $permission]);
            $adminRole->givePermissionTo($permission);
        }

        $admin = new User([
            'name' => 'Super Admin',
            'email' => 'admin@med-consulting.org',
            'phone' => '+9635568324',
            'password' => bcrypt('123')
        ]);
        $admin->save();
        $admin->assignRole('admin');
    }
}
