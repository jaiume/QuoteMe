<?php

namespace Database\Seeders;

use App\Models\User;
use App\Utils\PermissionUtils;
use Illuminate\Database\Seeder;
use \Hash;
use \Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Set users');

        $admin = new User();
        $admin->fill([
            'name' => 'QuoteMe Admin',
            'email' => 'admin@quoteme.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
        ]);
        $admin->save();
        $admin->assignRole(PermissionUtils::ROLE_SUPERADMIN, PermissionUtils::ROLE_ADMIN);

        $supplier = new User();
        $supplier->fill([
            'name' => 'QuoteMe Supplier',
            'email' => 'supplier@quoteme.com',
            'email_verified_at' => now(),
            'password' => Hash::make('supplier'),
            'remember_token' => Str::random(10),
        ]);
        $supplier->save();
        $supplier->assignRole(PermissionUtils::ROLE_SUPPLIER);

        $customer = new User();
        $customer->fill([
            'name' => 'QuoteMe Customer',
            'email' => 'customer@quoteme.com',
            'email_verified_at' => now(),
            'password' => Hash::make('customer'),
            'remember_token' => Str::random(10),
        ]);
        $customer->save();
        $customer->assignRole(PermissionUtils::ROLE_CUSTOMER);
    }
}
