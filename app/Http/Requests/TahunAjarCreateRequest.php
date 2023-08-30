<?php

namespace App\Http\Requests;

class TahunAjarCreateRequest extends CoreRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nama_tahun_ajar' => ['required'],
            'semester' => ['required', 'in:Genap,Ganjil'],
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
            'nama_tahun_ajar.required' => "Nama Kelas wajib diisi !!",
            'semester.required' => "Jurusan wajib diisi !!",
            'semester.in' => 'Semester hanya dapat diisi dengan "Ganjil" atau "Genap"',
            'status_data.in' => 'Status data hanya dapat diisi dengan "Aktif" atau "Tidak Aktif"',
        ];
    }

}
