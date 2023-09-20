<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiConsumptionController extends Controller
{
    public function consumirAPI()
    {
        // Acesse a API em JavaScript usando HTTP
        $response = Http::get('URL_DA_API_AQUI');

        if ($response->successful()) {
            $data = $response->json(); // Obtenha os dados da resposta em JSON
            // Manipule os dados conforme necessário
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Erro ao consumir a API'], $response->status());
        }
    }
}
