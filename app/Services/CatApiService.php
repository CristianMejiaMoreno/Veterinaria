<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
class CatApiService
{

    private string $baseUrl;
    private string $apiKey;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->baseUrl = "https://api.thecatapi.com/v1";
        $this->apiKey  = config('services.cat_api.key');

    }

    /**
     * Obtiene todas las razas de gatos
     * @return void
     */
    public function getCatsByBreed(): array
    {
        $endpoint = $this->baseUrl . '/breeds';

        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
        ])->get($endpoint);

        if ($response->failed()) {
            Log::error('Error CatAPI', ['body' => $response->body()]);

            throw new Exception('No se pudo obtener la información de las razas de gatos.');
        }

        return $response->json();
    }
}
