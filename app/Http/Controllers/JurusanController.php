<?php

namespace App\Http\Controllers;

use App\Http\Resources\KelasResource;
use App\Models\JurusanModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    // mendapatkan seluruh data
    public function get (): JsonResponse
    {
        $data = JurusanModel::all();
        return KelasResource::collection($data)->response()->setStatusCode(200);
    }
    public function getUntukInputOption (): JsonResponse
    {
        $data = JurusanModel::select("id_jurusan", "nama_jurusan")->get();
        return KelasResource::collection($data)->response()->setStatusCode(200);
    }
}
