<?php

namespace App\Http\Requests;

class KelasCreateRequest extends CoreRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nama_kelas' => ['required'],
            'id_jurusan' => ['required'],
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
            'nama_kelas.required' => "Nama Kelas wajib diisi !!",
            'id_jurusan.required' => "Jurusan wajib diisi !!",
            'status_data.in' => 'Status data hanya dapat diisi dengan "Aktif" atau "Tidak Aktif"',
        ];
    }

}
