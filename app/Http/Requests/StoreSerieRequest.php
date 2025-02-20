<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSerieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title"                 => 'required|string|max:255',
            "description"           => 'string|nullable',
            "cover_image_url"       => 'url|nullable',
            "banner_image_url"      => 'url|nullable',
            "author"                => 'nullable|string|max:255',
            'type'                  => 'required',
            "status"                => 'required',
        ];
    }
}
