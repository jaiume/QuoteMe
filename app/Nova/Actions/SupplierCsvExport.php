<?php

namespace App\Nova\Actions;

use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\URL;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class SupplierCsvExport extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Indicates if this action is available to run against the entire resource.
     *
     * @var bool
     */
    public $availableForEntireResource = true;

    /**
     * Determine where the action redirection should be without confirmation.
     *
     * @var bool
     */
    public $withoutConfirmation = true;

    /**
     * Indicates if this action is only available on the resource index view.
     *
     * @var bool
     */
    public $onlyOnIndex = true;

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return $this->name ?: __('Download as CSV');
    }

    /**
     * CSV delimiter.
     */
    private const DELIMITER = ',';

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $executionStartedAt = Carbon::now();

        /* @var Collection $csvContents */
        $csvContents = collect([]);
        $csvContents->push(
            collect([
                'id',
                'email',
                'password',
                'name',
                'phone',
                'disabled',
                'created_at',
                'updated_at',
                'last_logged_in',
                'quick_notify'
            ])->join(self::DELIMITER)
        );

        $models->each(function ($model) use ($csvContents) {
            if (!$model instanceof Supplier) {
                return;
            }

            $csvContents->push(
                collect([
                    $model->id,
                    $model->email,
                    null,
                    $model->name,
                    $model->phone,
                    $model->disabled,
                    $model->created_at,
                    $model->updated_at,
                    $model->last_logged_in,
                    $model->quick_notify ? '1' : '0',
                ])->join(self::DELIMITER)
            );
        });

        \Storage::disk('temp')->put(
            $this->getFileName($executionStartedAt),
            $csvContents->join("\n")
        );

        return Action::download($this->getDownloadUrl($executionStartedAt), $this->getFileName($executionStartedAt));
    }

    /**
     * @param Carbon $date
     * @return string
     */
    protected function getDownloadUrl(Carbon $date): string
    {
        return URL::temporarySignedRoute('suppliers.csv-download', now()->addMinutes(1), [
            'path' => encrypt(\Storage::disk('temp')->path($this->getFileName($date))),
            'filename' => $this->getFileName($date),
        ]);
    }

    /**
     * @param Carbon $date
     * @return string
     */
    protected function getFileName(Carbon $date): string
    {
        return sprintf(
            '%s-suppliers-%s.csv',
            \Str::lower(config('app.name', 'quoteme')),
            $date->format('Ymd-His')
        );
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
