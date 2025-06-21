<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Log;

class DogApiService
{
    protected $baseUrl;
    protected $apiKey;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->baseUrl = "https://api.thedogapi.com/v1";
        $this->apiKey = config('services.dog_api.key');
    }

    public function getDogsByBreed()
    {
        $endpoint = $this->baseUrl . '/breeds';

        $response = Http::withHeaders([
            'x-api-key'=>$this->apiKey,
        ])->get($endpoint);

        if($response->failed())
        {
            throw new Exception('No se pudieron obtener las razas de perros');
        }

        return $response->json();
    }
    /**
     * Da un dato random pero es premium, asi que F
     */

    public function getRandomFact()
    {
        $endpoint = $this->baseUrl . '/facts';

        $response = Http::withHeaders([
            'x-api-key'=>$this->apiKey
        ])->get($endpoint);

        Log::info($response);

        return $response->json();
    }
}
