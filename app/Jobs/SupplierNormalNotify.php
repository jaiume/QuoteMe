<?php

namespace App\Jobs;

use App\Models\Request;
use App\Models\Supplier;
use App\Models\User;
use App\Notifications\SupplierRequestNotification;
use App\Utils\MessageUtils;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Foundation\Bus\Dispatchable;

class SupplierNormalNotify implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Request $request;
    protected Supplier $supplier;

    /**
     * SupplierNormalNotify constructor.
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
        $this->supplier->notify(
            new SupplierRequestNotification(
                MessageUtils::getNormalRequestEmail($this->request, $this->supplier)
            )
        );
    }

    public function uniqueId(): string
    {
        return sprintf('normalnotify:%s:%s', $this->supplier->id, $this->request->id);
    }
}
