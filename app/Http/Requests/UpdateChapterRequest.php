<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChapterRequest extends FormRequest
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
            //'id' => 'required| exists:chapters,id',
            'order_number'=>'required|numeric',
            'image_url' => 'nullable|url',
            'serie_id' => 'required| exists:series,id',
            //'owner_id' => 'required| exists:users,id',

        ];
    }
}
