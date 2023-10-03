<?php

namespace App\Http\Requests\Tabungan;
use App\Http\Requests\CoreRequest;


class RekeningCreateRequest extends CoreRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nomor_rekening' => 'nullable',
            'nis' => 'required',
            'saldo_awal' => 'required',
            'status_data' => ['nullable', 'in:Aktif,Tidak Aktif'],
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
            'nis.required' => "Pilihan siswa wajib diisi !!",
            'saldo_awal.required' => "Saldo awal wajib diisi !!",
            'status_data.in' => 'Status data hanya dapat diisi dengan "Aktif" atau "Tidak Aktif"',
        ];
    }
}
