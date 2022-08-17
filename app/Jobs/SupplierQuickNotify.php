<?php

namespace App\Jobs;

use App\Models\Request;
use App\Models\Supplier;
use App\Models\User;
use App\Notifications\SupplierQuickNotification;
use App\Utils\MessageUtils;
use App\Utils\SettingsUtils;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Foundation\Bus\Dispatchable;

class SupplierQuickNotify implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Request $request;
    protected Supplier $supplier;

    /**
     * SupplierQuickNotify constructor.
     *
     * @param Request $request
     * @param Supplier|User $supplier
     */
    public function __construct(Request $request, $supplier)
    {
        if ($supplier instanceof User) {
            $s = optional(Supplier::find($supplier->id))->withoutRelations();
            if ($s) {
                $this->supplier = $s;
            }
        } else {
            $this->supplier = $supplier->withoutRelations();
        }
        $this->request = $request->withoutRelations();
    }

    public function handle(): void
    {
        if (SettingsUtils::get('quick_notify_enabled', false)) {
            $this->supplier->notify(
                new SupplierQuickNotification(
                    MessageUtils::getQuickNotifySms($this->request, $this->supplier)
                )
            );

            CheckTwilioBalance::dispatch()->delay(\DateInterval::createFromDateString('30 seconds'));
        }
    }

    public function uniqueId(): string
    {
        return sprintf('quicknotify:%s:%s', $this->supplier->id, $this->request->id);
    }
}
