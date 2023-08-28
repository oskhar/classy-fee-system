<?php

namespace App\Http\Requests;


class KelasReadRequest extends CoreRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'start' => 'nullable|integer',
            'length' => 'nullable|integer',
            'search' => 'nullable',
            'orderColumn' => 'nullable',
            'orderDir' => 'nullable',
        ];
    }
}
