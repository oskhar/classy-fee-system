<?php

namespace App\Http\Controllers;

use App\Http\Resources\KelasResource;
use App\Models\KelasModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    // mendapatkan seluruh data
    public function get (): JsonResponse
    {
        $dataKelas = KelasModel::all();
        return KelasResource::collection($dataKelas)->response()->setStatusCode(200);
    }
}
