<?php

namespace App\Http\Requests\Tabungan;
use App\Http\Requests\CoreRequest;


class BukuTabunganReadRequest extends CoreRequest
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
            'nomor_rekening' => 'nullable',
            'id_tahun_ajar' => 'nullable',
            'id_kelas' => 'nullable',
        ];
    }
}
