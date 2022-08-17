<?php


namespace App\Nova;


use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

abstract class UserResource extends \Laravel\Nova\Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Users';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public function title(): string
    {
        return $this->name ?? $this->email;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name', 'email', 'phone'
    ];

    /**
     * The columns that should be filled AFTER the model is created.
     * Useful for related fields.
     *
     * @var string[]
     */
    protected static $metaFields = [];

    /**
     * Fill the given fields for the model.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param \Illuminate\Support\Collection $fields
     * @return array
     */
    protected static function fillFields(NovaRequest $request, $model, $fields): ?array
    {
        $metaData = $request->only(static::$metaFields);

        foreach (static::$metaFields as $field) {
            $request->request->remove($field);
        }

        $result = parent::fillFields($request, $model, $fields);
        $result[1][] = function () use ($metaData, $model) {
            $model->fill($metaData);
        };

        return $result;
    }
}
