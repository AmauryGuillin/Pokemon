<?php

namespace Database\Seeders;

use App\Models\Pokedex;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class PokedexSeeder extends Seeder
{

    private const LANGUAGE = 'fr';

    /**
     * Convert a number from one unit to another (e.g., decimeters to meters).
     */
    private function convertNumber(int $value, string $from, string $to): float
    {
        $const['dm'] = 10; // decimetre
        $const['m'] = 1; // metre
        $const['dg'] = 1000; // decigramme
        $const['kg'] = 100; // kilogramme

        if (!array_key_exists($from, $const) || !array_key_exists($to, $const)) return 0;

        return $value * $const[$to] / $const[$from];
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        for ($i = 1; $i <= 151; $i++) {

            $pokedexModel = new Pokedex();

            // Get the attack from POKéAPI
            $responsePokemon = Http::get('https://pokeapi.co/api/v2/pokemon/' . $i);
            $pokemon = $responsePokemon->json();

            // number
            $pokedexModel->number = $pokemon['order'];

            // image_artwork
            $pokedexModel->image_artwork = $pokemon['sprites']['other']['official-artwork']['front_default'];

            // image_front
            $pokedexModel->image_front = $pokemon['sprites']['front_default'];

            // image_back
            $pokedexModel->image_back = $pokemon['sprites']['back_default'];

            // height
            $heightUnformatted = $pokemon['height'];
            $pokedexModel->height = $this->convertNumber($heightUnformatted, 'dm', 'm');


            // weight
            $weightUnformatted = $pokemon['weight'];
            $pokedexModel->weight = $this->convertNumber($weightUnformatted, 'dg', 'kg');

            // cry
            $pokedexModel->cry = $pokemon['cries']['legacy'];

            // stats
            foreach ($pokemon["stats"] as $stat) {
                if ($stat['stat']['name'] === 'hp') $pokedexModel->stat_hp = $stat['base_stat'];
                if ($stat['stat']['name'] === 'attack') $pokedexModel->stat_attack = $stat['base_stat'];
                if ($stat['stat']['name'] === 'defense') $pokedexModel->stat_defense = $stat['base_stat'];
                if ($stat['stat']['name'] === 'special-attack') $pokedexModel->stat_special_attack = $stat['base_stat'];
                if ($stat['stat']['name'] === 'special-attack') $pokedexModel->stat_special_defense = $stat['base_stat'];
                if ($stat['stat']['name'] === 'speed') $pokedexModel->stat_speed = $stat['base_stat'];
            }


            // Types
            $countType = 0;

            foreach ($pokemon['types'] as $type) {
                $typeNamesUrl = $type['type']['url'];
                $typeNamesReq = Http::get($typeNamesUrl);
                $typeNames = $typeNamesReq->json();
                foreach ($typeNames['names'] as $name) {
                    if ($name['language']['name'] === self::LANGUAGE) {
                        $retrivedTypeName = $name['name'];
                        $typeId = Type::where('name', $retrivedTypeName)->first();
                        $countType === 0 ? $pokedexModel->type_prime_id = $typeId->id : $pokedexModel->type_second_id = $typeId->id; // type_prime_id and type_second_id
                        $countType++;
                    }
                }
            }

            // Strengths and Weaknesses
            $countWeakness = 0;
            $countStrength = 0;

            foreach ($pokemon['types'] as $type) {
                $typeNamesUrl = $type['type']['url'];
                $typeData = Http::get($typeNamesUrl)->json();

                foreach ($typeData['damage_relations']['double_damage_from'] as $weakness) {
                    if ($countWeakness < 6) {
                        $weaknessNamesReq = Http::get($weakness['url'])->json();
                        foreach ($weaknessNamesReq['names'] as $weaknessName) {
                            if ($weaknessName['language']['name'] === self::LANGUAGE) {
                                $retrivedWeaknessName = $weaknessName['name'];
                                $weaknessType = Type::where('name', $retrivedWeaknessName)->first();
                                if ($weaknessType) {
                                    if ($countWeakness === 0) {
                                        $pokedexModel->weakness_prime_id = $weaknessType->id; //weakness_prime_id
                                    } elseif ($countWeakness === 1) {
                                        $pokedexModel->weakness_second_id = $weaknessType->id; //weakness_second_id
                                    } elseif ($countWeakness === 2) {
                                        $pokedexModel->weakness_tertiary_id = $weaknessType->id; //weakness_tertiary_id
                                    } elseif ($countWeakness === 3) {
                                        $pokedexModel->weakness_fourth_id = $weaknessType->id; //weakness_fourth_id
                                    } elseif ($countWeakness === 4) {
                                        $pokedexModel->weakness_fifth_id = $weaknessType->id; //weakness_fifth_id
                                    } elseif ($countWeakness === 5) {
                                        $pokedexModel->weakness_sixth_id = $weaknessType->id; //weakness_sixth_id
                                    }
                                    $countWeakness++;
                                }
                                break;
                            }
                        }
                    }
                }

                foreach ($typeData['damage_relations']['double_damage_to'] as $strength) {
                    if ($countStrength < 6) {
                        $strengthNamesReq = Http::get($strength['url'])->json();
                        foreach ($strengthNamesReq['names'] as $strengthName) {
                            if ($strengthName['language']['name'] === self::LANGUAGE) {
                                $retrivedStrengthName = $strengthName['name'];
                                $strengthType = Type::where('name', $retrivedStrengthName)->first();
                                if ($strengthType) {
                                    if ($countStrength === 0) {
                                        $pokedexModel->strengh_prime_id = $strengthType->id; //strengh_prime_id
                                    } elseif ($countStrength === 1) {
                                        $pokedexModel->strengh_second_id = $strengthType->id; //strengh_second_id
                                    } elseif ($countStrength === 2) {
                                        $pokedexModel->strengh_tertiary_id = $strengthType->id; //strengh_tertiary_id
                                    } elseif ($countStrength === 3) {
                                        $pokedexModel->strengh_fourth_id = $strengthType->id; //strengh_fourth_id
                                    } elseif ($countStrength === 4) {
                                        $pokedexModel->strengh_fifth_id = $strengthType->id; //strengh_fifth_id
                                    } elseif ($countStrength === 5) {
                                        $pokedexModel->strengh_sixth_id = $strengthType->id; //strengh_sixth_id
                                    }
                                    $countStrength++;
                                }
                                break;
                            }
                        }
                    }
                }
            }


            //=====================TODO=====================
            //**********************************************
            //====================ATTACKS===================
            //**********************************************
            //=====================TODO=====================


            $responseSpecies = Http::get('https://pokeapi.co/api/v2/pokemon-species/' . $i);
            $pokemonSpecies = $responseSpecies->json();

            // description
            foreach ($pokemonSpecies['flavor_text_entries'] as $description) {
                if ($description['language']['name'] === self::LANGUAGE) {
                    $pokedexModel->description = $description['flavor_text'];
                    break;
                }
            }

            // name
            foreach ($pokemonSpecies['names'] as $name) {
                if ($name['language']['name'] === self::LANGUAGE) {
                    $pokedexModel->name = $name['name'];
                    break;
                }
            }

            // category
            foreach ($pokemonSpecies['genera'] as $category) {
                if ($category['language']['name'] === self::LANGUAGE) {
                    $pokedexModel->category = $category['genus'];
                    break;
                }
            }

            // evolve_from 
            if (!is_null($pokemonSpecies['evolves_from_species'])) {
                $evolvesFromUrl = $pokemonSpecies['evolves_from_species']['url'];
                $responseEvolvesFrom = Http::get($evolvesFromUrl);
                $evolvesFromData = $responseEvolvesFrom->json();
                foreach ($evolvesFromData['names'] as $name) {
                    if ($name['language']['name'] === self::LANGUAGE) {
                        $pokedexModel->evolve_from = $name['name'];
                        break;
                    }
                }
            } else {
                $pokedexModel->evolve_from = null;
            }

            // evolve_to
            $responseEvolution = Http::get($pokemonSpecies['evolution_chain']['url']);
            $evolutionChain = $responseEvolution->json();

            // Find the next evolution stage
            $currentPokemon = $evolutionChain['chain'];
            while ($currentPokemon['species']['name'] !== $pokemonSpecies['name']) {
                $currentPokemon = $currentPokemon['evolves_to'][0] ?? null;
                if (!$currentPokemon) {
                    break;
                }
            }

            // If evolves_to is not empty, retrieve the next Pokémon's name in French
            if (!empty($currentPokemon['evolves_to'])) {
                $nextEvolutionUrl = $currentPokemon['evolves_to'][0]['species']['url'];
                $responseEvolvesTo = Http::get($nextEvolutionUrl);
                $evolvesToData = $responseEvolvesTo->json();
                foreach ($evolvesToData['names'] as $name) {
                    if ($name['language']['name'] === self::LANGUAGE) {
                        $pokedexModel->evolve_to = $name['name'];
                        break;
                    }
                }
            } else {
                $pokedexModel->evolve_to = null;
            }

            $pokedexModel->save();

            echo ('pokemon : ' . $i . "\n");
        }

        echo 'Gen I pokemons successfully added to DB';
    }
}
