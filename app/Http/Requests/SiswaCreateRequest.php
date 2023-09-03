<?php

namespace App\Http\Requests;

class SiswaCreateRequest extends CoreRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nama_siswa' => ['required'],
            'nis' => ['required'],
            'nisn' => ['required'],
            'agama' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'jenis_kelamin' => ['required'],
            'alamat' => ['required'],
            'nama_ayah' => ['nullable'],
            'pekerjaan_ayah' => ['nullable'],
            'penghasilan_ayah' => ['nullable'],
            'nama_ibu' => ['nullable'],
            'pekerjaan_ibu' => ['nullable'],
            'penghasilan_ibu' => ['nullable'],
            'telp_rumah' => ['required'],
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
            'nama_siswa.required' => "Nama siswa wajib diisi !!",
            'id_wali_siswa.required' => "Jurusan wajib diisi !!",
            'status_data.in' => 'Status data hanya dapat diisi dengan "Aktif" atau "Tidak Aktif"',
        ];
    }

}
