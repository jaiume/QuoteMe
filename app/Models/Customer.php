<?php

namespace App\Models;

use App\Utils\PermissionUtils;
use App\Utils\UserMetaUtils;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;

/**
 * Class Customer
 *
 * @property-read Collection|Request[] $requests
 * @property-read Collection|Response[] $responses
 * @property-read Collection|Response[] $unread_responses
 * @property-read string $display_name
 * @property-read string $auth_link
 * @property bool $quick_contact
 * @property bool $quick_reply
 *
 * @mixin User
 * @package App\Models
 */
class Customer extends User
{
    use HasFactory;
    use Searchable;

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
            'quick_contact',
            'quick_reply'
        ]);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope('customer', function (Builder $builder) {
            $customers = DB::table('users')
                           ->select('users.id as c_id')
                           ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                           ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                           ->where('model_has_roles.model_type', User::class)
                           ->where('roles.name', PermissionUtils::ROLE_CUSTOMER);

            $builder->select(['users.*'])
                    ->joinSub($customers, 'customers', function ($join) {
                        $join->on('users.id', '=', 'customers.c_id');
                    });
        });

        static::created(function (Customer $customer) {
            $user = User::find($customer->id);
            $user->assignRole(PermissionUtils::ROLE_CUSTOMER);
        });
    }

    /**
     * @return HasMany
     */
    public function requests(): HasMany
    {
        return $this->hasMany(Request::class, 'user_id');
    }

    /**
     * Returns the name if exists or email if
     *
     * @return string
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name ?? $this->email;
    }

    /**
     * @return Collection
     */
    public function getUnreadResponsesAttribute(): Collection
    {
        $responses = $this->responses;
        $now = Carbon::now();

        return $responses->filter(function (Response $response) use ($now) {
            return ($response->viewed_at === null || $response->viewed_at->greaterThan($now));
        });
    }

    /**
     * @return Collection
     */
    public function getResponsesAttribute(): Collection
    {
        $responses = [];

        foreach ($this->requests as $request) {
            $responses[] = $request->responses;
        }

        return collect($responses)->flatten();
    }

    /**
     * Get QuickContact setting enabled status
     *
     * @return bool
     */
    public function getQuickContactAttribute(): bool
    {
        if (!$this->phone) {
            return false;
        }

        $query = DB::table('users_meta')
                   ->select('value')
                   ->where('key', UserMetaUtils::QUICK_CONTACT)
                   ->where('user_id', $this->id)
                   ->pluck('value');

        return $query->first() === '1';
    }

    /**
     * Set QuickContact setting enabled status
     *
     * @param bool $value
     */
    public function setQuickContactAttribute(bool $value): void
    {
        DB::table('users_meta')
          ->updateOrInsert(
              [
                  'key' => UserMetaUtils::QUICK_CONTACT,
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
     * Get QuickReply setting enabled status
     *
     * @return bool
     */
    public function getQuickReplyAttribute(): bool
    {
        if (!$this->phone) {
            return false;
        }

        $query = DB::table('users_meta')
                   ->select('value')
                   ->where('key', UserMetaUtils::QUICK_REPLY)
                   ->where('user_id', $this->id)
                   ->pluck('value');

        return $query->first() === '1';
    }

    /**
     * Set QuickReply setting enabled status
     *
     * @param bool $value
     */
    public function setQuickReplyAttribute(bool $value): void
    {
        DB::table('users_meta')
          ->updateOrInsert(
              [
                  'key' => UserMetaUtils::QUICK_REPLY,
                  'user_id' => $this->id,
              ],
              [
                  'value' => $value ? '1' : '0',
                  'created_at' => DB::raw('IFNULL(users_meta.created_at, NOW())'),
                  'updated_at' => Carbon::now(),
              ],
          );
    }

    public function getAuthLinkAttribute(): string
    {
        return route('customer.home', ['auth_token' => $this->auth_token]);
    }

    /**
     * Get QuickReply setting enabled status
     *
     * @return bool
     */
    public function isQuickReplyEnabled(): bool
    {
        return $this->quick_reply;
    }

    /**
     * Get QuickContact setting enabled status
     *
     * @return bool
     */
    public function isQuickContactEnabled(): bool
    {
        return $this->quick_contact;
    }

    /**
     * @return array
     */
    public function toSearchableArray(): array
    {
        return parent::toSearchableArray();
    }
}
