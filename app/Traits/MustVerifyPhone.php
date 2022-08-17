<?php


namespace App\Traits;


use App\Notifications\VerifyPhone;
use Illuminate\Support\Facades\Redis;

trait MustVerifyPhone
{
    private function getCodeStorageKey(): string
    {
        return sprintf('phone-verification:%s:%s', static::class, $this->id);
    }
    protected function generatePhoneVerificationCode(): ?string
    {
        $code = substr(str_shuffle('0123456789'), 0, 6);

        Redis::set($this->getCodeStorageKey(), $code);

        return $code;
    }

    public function verifyPhone(string $code): bool
    {
        $savedCode = Redis::get($this->getCodeStorageKey());

        if ($savedCode === $code) {
            $this->markPhoneAsVerified();
            return true;
        }

        return false;
    }

    public function hasVerifiedPhone(): bool
    {
        if ($this->phone) {
            return !is_null($this->phone_verified_at);
        }

        return true;
    }

    public function markPhoneAsVerified(): bool
    {
        Redis::del([$this->getCodeStorageKey()]);

        return $this->forceFill([
            'phone_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function sendPhoneVerificationNotification(): void
    {
        $this->notify(new VerifyPhone($this->generatePhoneVerificationCode()));
    }

    public function getPhoneForVerification()
    {
        return $this->phone;
    }
}
