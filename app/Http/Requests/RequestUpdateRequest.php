<?php

namespace App\Http\Requests;

use App\Models\Customer;
use App\Models\Request;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RequestUpdateRequest
 *
 * @property-read Customer|null $customer
 *
 * @package App\Http\Requests
 */
class RequestUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if ($this->customer instanceof Customer) {
            $request = Request::find($this->route('id'));

            return optional(optional($request)->customer)->id === $this->customer->id;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'cancelled' => 'boolean',
        ];
    }
}
