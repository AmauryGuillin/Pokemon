<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TypeSeeder extends Seeder
{

    private const LANGUAGE = 'fr';


    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 1; $i <= 19; $i++) {
            $response = Http::get('https://pokeapi.co/api/v2/type/' . $i);
            $type = $response->json();

            // Vérifier si la génération est "generation-i"
            if ($type['generation']['name'] === 'generation-i') {
                // Parcourir les noms et filtrer par langue
                foreach ($type['names'] as $name) {
                    if ($name['language']['name'] === self::LANGUAGE) {
                        $typeModel = new Type();
                        $typeModel->name = $name['name'];

                        // Insert to database
                        $typeModel->save();
                    }
                }
            }
        }

        echo 'Gen I types successfully added to DB';
    }
}
