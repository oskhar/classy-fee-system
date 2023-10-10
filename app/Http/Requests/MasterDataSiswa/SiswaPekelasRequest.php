<?php

namespace App\Http\Requests\MasterDataSiswa;

use App\Http\Requests\CoreRequest;
use Illuminate\Foundation\Http\FormRequest;

class SiswaPekelasRequest extends CoreRequest
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
            'id_tahun_ajar' => 'nullable',
            'id_kelas' => 'nullable',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function messages(): array
    {
        return [
        ];
    }
}
