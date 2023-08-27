<?php

namespace App\Http\Requests;

class JurusanDeleteRequest extends CoreRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id_kelas' => 'required',
        ];
    }
}
