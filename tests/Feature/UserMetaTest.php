<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\User;
use App\Utils\PermissionUtils;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

/**
 * Class UserMetaTest
 * @package Tests\Feature
 */
class UserMetaTest extends TestCase
{
    use RefreshDatabase;

    /**
     *
     */
    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('db:seed');
    }

    /**
     *
     */
    public function testAdmin(): void
    {
        $role = Role::findByName(PermissionUtils::ROLE_ADMIN);

        /* @var User $user */
        $user = User::factory()->state([
            'name' => 'Test Admin',
        ])->create();
        $user->syncRoles($role);

        $admin = Admin::find($user->id);
        $this->assertInstanceOf(Admin::class, $admin);

        $this->assertIsBool($admin->isCreditNotificationEnabled());
        $this->assertIsBool($admin->isLowSmsNotificationEnabled());
    }

    /**
     *
     */
    public function testSupplier(): void
    {
        $role = Role::findByName(PermissionUtils::ROLE_SUPPLIER);

        $user = User::factory()->state([
            'name' => 'Test Supplier',
        ])->create();
        $user->syncRoles($role);

        $supplier = Supplier::find($user->id);
        $this->assertInstanceOf(Supplier::class, $supplier);
        $this->assertIsBool($supplier->quick_notify);
    }

    /**
     *
     */
    public function testCustomer(): void
    {
        $role = Role::findByName(PermissionUtils::ROLE_CUSTOMER);

        /* @var User $user */
        $user = User::factory()->state([
            'name' => 'Test Customer',
        ])->create();
        $user->syncRoles($role);

        $customer = Customer::find($user->id);
        $this->assertInstanceOf(Customer::class, $customer);

        $this->assertIsBool($customer->isQuickContactEnabled());
        $this->assertIsBool($customer->isQuickReplyEnabled());
    }
}
