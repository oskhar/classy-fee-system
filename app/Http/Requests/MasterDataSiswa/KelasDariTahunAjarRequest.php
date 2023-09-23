<?php

namespace App\Http\MasterDataSiswa\Requests;

use App\Http\Requests\CoreRequest;
use Illuminate\Foundation\Http\FormRequest;

class KelasDariTahunAjarRequest extends CoreRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nama_tahun_ajar' => 'required',
            'semester' => 'required|in:Ganjil,Genap',
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
            'nama_tahun_ajar.required' => "Nama tahun ajar wajib diisi !!",
            'semester.required' => "Semester wajib diisi !!",
            'semester.in' => 'Data semester hanya dapat diisi dengan "Ganjil" atau "Genap"',
        ];
    }
}
