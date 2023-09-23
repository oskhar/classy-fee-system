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
            'id_tahun_ajar' => 'required',
            'id_kelas' => 'required',
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
            'id_tahun_ajar.required' => "Id tahun ajar wajib diisi !!",
            'id_kelas.required' => "Id kelas wajib diisi !!",
        ];
    }
}
