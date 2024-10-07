<?php

namespace Database\Seeders;

use App\Models\Attack;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class AttackSeeder extends Seeder
{

    private const LANGUAGE = 'fr';
    private const GENERATION = 'generation-i';
    private const DESCRIPTION_GAME = 'omega-ruby-alpha-sapphire';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 1; $i <= 166; $i++) {
            // Initiate a new Attack Object
            $attackModel = new Attack();

            // Get the attack from POKéAPI
            $response = Http::get('https://pokeapi.co/api/v2/move/' . $i);
            $attack = $response->json();

            // Check if attack is from generation I
            if ($attack['generation']['name'] === self::GENERATION) {
                // Browse names and filter by language
                foreach ($attack['names'] as $name) {
                    if ($name['language']['name'] === self::LANGUAGE) {

                        $attackModel->name = $name['name'];
                    }
                }

                // Get pp, power, accuracy and description
                $attackModel->pp = $attack['pp'];
                $attackModel->power = $attack['power'];
                $attackModel->accuracy = $attack['accuracy'];
                foreach ($attack['flavor_text_entries'] as $description) {
                    if ($description['language']['name'] === self::LANGUAGE && $description['version_group']['name'] === self::DESCRIPTION_GAME) {
                        $attackModel->description = $description['flavor_text'];
                    }
                }

                // Get type
                $storedTypes = Type::all();
                $typeNamesUrl = $attack['type']['url'];
                $typeNames = Http::get($typeNamesUrl);

                foreach ($typeNames['names'] as $name) {
                    if ($name['language']['name'] === self::LANGUAGE) {
                        $retreivedType = $name['name'];
                        break;
                    }
                }

                foreach ($storedTypes->toArray() as $typeS) {
                    if ($retreivedType === $typeS['name']) {
                        $typeId = Type::where('name', $retreivedType)->first();
                        $attackModel->type_id = $typeId->id;
                        break;
                    }
                }

                // Insert to DB
                $attackModel->save();
            }
            echo ("attack : " . $i . "\n");
        }

        echo 'Gen I attacks successfully added to DB';
    }
}
