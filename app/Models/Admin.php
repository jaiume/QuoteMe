<?php

namespace App\Models;

use App\Utils\PermissionUtils;
use App\Utils\UserMetaUtils;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;

/**
 * Class Admin
 *
 * @property bool $credit_notification
 * @property bool $low_sms_notification
 *
 * @mixin User
 * @package App\Models
 */
class Admin extends User
{
    use HasFactory;
    use Searchable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->mergeFillable([
            'credit_notification',
            'low_sms_notification'
        ]);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope('admin', function (Builder $builder) {
            $admins = DB::table('users')
                           ->select('users.id as a_id')
                           ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                           ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                           ->where('model_has_roles.model_type', User::class)
                           ->where('roles.name', PermissionUtils::ROLE_ADMIN);

            $builder->select(['users.*'])
                    ->joinSub($admins, 'admin', function ($join) {
                        $join->on('users.id', '=', 'admin.a_id');
                    });
        });

        static::created(function (Admin $admin) {
            $user = User::find($admin->id);
            $user->assignRole(PermissionUtils::ROLE_ADMIN);
        });
    }

    /**
     * Get CreditNotification setting enabled status
     *
     * @return bool
     */
    public function getCreditNotificationAttribute(): bool
    {
        $query = DB::table('users_meta')
                   ->select('value')
                   ->where('key', UserMetaUtils::CREDIT_NOTIFICATION)
                   ->where('user_id', $this->id)
                   ->pluck('value');

        return $query->first() === '1';
    }

    /**
     * Set CreditNotification setting enabled status
     *
     * @param bool $value
     */
    public function setCreditNotificationAttribute(bool $value): void
    {
        DB::table('users_meta')
          ->updateOrInsert(
              [
                  'key' => UserMetaUtils::CREDIT_NOTIFICATION,
                  'user_id' => $this->id,
              ],
              [
                  'value' => $value ? '1' : '0',
                  'created_at' => DB::raw('IFNULL(users_meta.created_at, NOW())'),
                  'updated_at' => Carbon::now(),
              ],
          );
    }

    /**
     * Get LowSmsNotification setting enabled status
     *
     * @return bool
     */
    public function getLowSmsNotificationAttribute(): bool
    {
        $query = DB::table('users_meta')
                   ->select('value')
                   ->where('key', UserMetaUtils::LOW_SMS)
                   ->where('user_id', $this->id)
                   ->pluck('value');

        return $query->first() === '1';
    }

    /**
     * Set LowSmsNotification setting enabled status
     *
     * @param bool $value
     */
    public function setLowSmsNotificationAttribute(bool $value): void
    {
        DB::table('users_meta')
          ->updateOrInsert(
              [
                  'key' => UserMetaUtils::LOW_SMS,
                  'user_id' => $this->id,
              ],
              [
                  'value' => $value ? '1' : '0',
                  'created_at' => DB::raw('IFNULL(users_meta.created_at, NOW())'),
                  'updated_at' => Carbon::now(),
              ],
          );
    }

    /**
     * Get LowSmsNotification setting enabled status
     *
     * @return bool
     */
    public function isLowSmsNotificationEnabled(): bool
    {
        return $this->low_sms_notification;
    }

    /**
     * Get CreditPurchaseNotification setting enabled status
     *
     * @return bool
     */
    public function isCreditNotificationEnabled(): bool
    {
        return $this->credit_notification;
    }

    /**
     * @return array
     */
    public function toSearchableArray(): array
    {
        return parent::toSearchableArray();
    }
}
