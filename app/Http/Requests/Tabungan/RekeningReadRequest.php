<?php

namespace App\Http\Requests\Tabungan;
use App\Http\Requests\CoreRequest;


class RekeningReadRequest extends CoreRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id_jurusan' => 'nullable',
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
