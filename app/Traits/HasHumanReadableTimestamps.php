<?php


namespace App\Traits;


use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;

/**
 * Trait HasHumanReadableTimestamps
 *
 * @property string|null created_at_relative
 *
 * @package App\Traits
 */
trait HasHumanReadableTimestamps
{
    /**
     * @return string|null
     */
    public function getCreatedAtRelativeAttribute(): ?string
    {
        $now = Carbon::now();

        return optional($this->created_at)->diffForHumans($now, [
            'options' => 0 | Carbon::JUST_NOW | Carbon::ONE_DAY_WORDS,
            'syntax' => CarbonInterface::DIFF_RELATIVE_TO_NOW,
        ]);
    }
}
