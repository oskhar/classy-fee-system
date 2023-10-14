<?php

namespace App\Http\Requests\Tabungan;
use App\Http\Requests\CoreRequest;


class TransaksiTabunganCreateRequest extends CoreRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nomor_rekening' => 'required',
            'jenis_transaksi' => 'required',
            'nominal' => 'required',
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
            'nomor_rekening.required' => "Nomor rekening wajib diisi !!",
            'kredit.required' => "Kredit wajib diisi !!",
            'debit.required' => "Debit wajib diisi !!",
            'status_data.in' => 'Status data hanya dapat diisi dengan "Aktif" atau "Tidak Aktif"',
        ];
    }
}
