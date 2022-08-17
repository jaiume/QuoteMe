<?php

namespace App\Models;

use App\Casts\PhoneNumberCast;
use App\Events\AuthTokenCreated;
use App\Utils\CacheUtils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 *
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $phone
 * @property string $auth_token
 * @property Collection|CreditTransaction[] $transactions
 * @property bool $disabled
 * @property Carbon|null $last_logged_in
 * @property Carbon|null $email_verified_at
 * @property Carbon|null $phone_verified_at
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @mixin \Eloquent
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasRoles;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'last_logged_in',
    ];

    protected $guarded = [
        'disabled',
        'auth_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_logged_in' => 'datetime',
        'disabled' => 'boolean',
        'phone' => PhoneNumberCast::class,
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(CreditTransaction::class, 'user_id');
    }

    public function isDisabled(): bool
    {
        return $this->disabled ?? false;
    }

    public function isEnabled(): bool
    {
        return !$this->isDisabled();
    }

    public function getWalletBalance(): int
    {
        return Cache::tags([
            CacheUtils::TAG_TRANSACTION,
        ])->remember(
            CacheUtils::getUserWalletBalanceCacheName($this->id),
            \DateInterval::createFromDateString('1 hour'),
            function () {
                $transactions = $this->transactions()->successful()->select('amount')->get();
                return $transactions->reduce(function ($accum, CreditTransaction $transaction) {
                    return $accum + $transaction->amount;
                }, 0);
            }
        );
    }

    public function routeNotificationForTwilio(): string
    {
        return $this->phone;
    }

    /**
     * @param int|float $amount Amount of credits you want to charge from user.
     * @return bool
     */
    public function hasEnoughCredits($amount): bool
    {
        $walletBalance = $this->getWalletBalance();

        return $walletBalance >= $amount;
    }

    public function resetEmail(): bool
    {
        $response = Password::broker()->sendResetLink([
            'email' => $this->email,
        ]);

        return $response === Password::RESET_LINK_SENT || $response === Password::RESET_THROTTLED;
    }

    public function generateAuthToken(): void
    {
        $this->setAttribute('auth_token', Str::random(20));

        if ($this->save()) {
            event(new AuthTokenCreated(Customer::find($this->id)));
        }
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray(): array
    {
        return $this->only('id', 'name', 'email', 'phone');
    }
}
