<?php

namespace Database\Seeders;

use App\Models\Especie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EspecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('datasets/especies/translation.json'));

        $data = json_decode($json, true);

        foreach($data as $nombre_cientifico => $nombre)
        {
            Especie::create([
                'nombre'=>$nombre,
                'nombre_cientifico'=>$nombre_cientifico
            ]);
        }

        $this->command->info("Seeder ejecutado correctamente");
    }
}
