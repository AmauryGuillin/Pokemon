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

            // Browse names and filter by language
            foreach ($type['names'] as $name) {
                if ($name['language']['name'] === self::LANGUAGE) {
                    $typeModel = new Type();
                    $typeModel->name = $name['name'];

                    // Insert to database
                    $typeModel->save();
                    break;
                }
            }

            echo 'type : ' . $i . "\n";
        }

        echo 'Gen I types successfully added to DB';
    }
}
