<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class KelasCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nama_kelas' => ['required', 'unique:tb_kelas'],
            'id_jurusan' => ['required'],
            'status_data' => ['required'],
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
            'nama_kelas.unique' => "Nama Kelas sudah digunakan !! Harap menggunakan nama kelas lain",
            'nama_kelas.required' => "Nama Kelas wajib diisi !!",
            'id_jurusan.required' => "Jurusan wajib diisi !!",
        ];
    }

    /**
     * Aksi saat data tervalidasi salah
     * @param Validator
     */
    public function failedValidation (Validator $validator)
    {
        throw new HttpResponseException(response([
            "errors" => $validator->getMessageBag()
        ], 400));
    }
}
