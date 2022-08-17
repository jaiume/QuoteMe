<?php

namespace Database\Seeders;

use App\Utils\PermissionUtils;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Set roles and permissions');

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permNovaAccess = Permission::create(['name' => PermissionUtils::NOVA_ACCESS]);
        $permNovaResUsers = Permission::create(['name' => PermissionUtils::NOVA_RES_USERS_ACCESS]);
        $permNovaToolsSettings = Permission::create(['name' => PermissionUtils::NOVA_TOOLS_SETTINGS_ACCESS]);

        $permMetaCreditNotification = Permission::create(['name' => PermissionUtils::META_CREDIT_NOTIFICATION]);
        $permMetaLowSms = Permission::create(['name' => PermissionUtils::META_LOW_SMS]);
        $permMetaQuickNotify = Permission::create(['name' => PermissionUtils::META_QUICK_NOTIFY]);
        $permMetaQuickContact = Permission::create(['name' => PermissionUtils::META_QUICK_CONTACT]);
        $permMetaQuickReply = Permission::create(['name' => PermissionUtils::META_QUICK_REPLY]);

        /* @var Role $roleSuperadmin */
        $roleSuperadmin = Role::create(['name' => PermissionUtils::ROLE_SUPERADMIN]);
        $roleSuperadmin->givePermissionTo(Permission::all());

        /* @var Role $roleAdmin */
        $roleAdmin = Role::create(['name' => PermissionUtils::ROLE_ADMIN]);
        $roleAdmin->givePermissionTo(
            $permNovaAccess,
            $permNovaResUsers,
            $permNovaToolsSettings,
            $permMetaCreditNotification,
            $permMetaLowSms
        );

        /* @var Role $roleSupplier */
        $roleSupplier = Role::create(['name' => PermissionUtils::ROLE_SUPPLIER]);
        $roleSupplier->givePermissionTo(
            $permNovaAccess,
            $permMetaQuickNotify
        );

        /* @var Role $roleCustomer */
        $roleCustomer = Role::create(['name' => PermissionUtils::ROLE_CUSTOMER]);
        $roleCustomer->givePermissionTo(
            $permMetaQuickContact,
            $permMetaQuickReply,
        );
    }
}
