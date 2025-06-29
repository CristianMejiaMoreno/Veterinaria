<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; 

class ImagenService
{
    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Convierte la imagen a WebP (70 % de calidad ≈ 30 % menos),
     * la guarda en storage/app/public/$carpeta
     * y devuelve la ruta relativa para asset('storage/…').
     */
    public function guardarImagen(string $carpeta, UploadedFile $imagen): string
    {
        $fileName = Str::uuid() . '.webp';

        $relativePath = "{$carpeta}/{$fileName}";

        // Procesar la imagen con compresión al 70%
        $webpBinario = $this->manager
            ->read($imagen->getRealPath())   
            ->toWebp(70)                     // Convierte a webp con 70% de calidad
            ->toString();                    

        // Guardar en el disco "public" (storage/app/public)
        Storage::disk('public')->put($relativePath, $webpBinario);

        return $relativePath;
    }
}
