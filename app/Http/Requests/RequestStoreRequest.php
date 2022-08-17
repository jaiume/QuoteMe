<?php

namespace App\Http\Requests;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RequestStoreRequest
 *
 * @property-read Customer|null $customer
 *
 * @package App\Http\Requests
 */
class RequestStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:5',
            'email' => 'required|email|min:5',
            'area' => 'required|array|min:1|exists:areas,id',
            'category' => 'required|array|min:1|exists:categories,id',
            'description' => 'required|string|min:5',
            'url' => 'nullable|string|min:8',
            'photo' => 'nullable|image|mimes:png,jpeg,jpg,gif|max:' . round(config('media-library.max_file_size', 1024 * 1024 * 10) / 1024),
            'quick_reply' => 'nullable|boolean',
            'quick_contact' => 'nullable|boolean',
            'phone' => 'nullable|required_with:quick_reply,quick_contact|phone:AUTO',
        ];
    }
}
