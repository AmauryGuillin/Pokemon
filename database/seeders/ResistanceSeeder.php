<?php

namespace Database\Seeders;

use App\Models\Pokemon;
use App\Models\Resistances;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ResistanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $max = Pokemon::all()->count();

        for ($i = 1; $i <= $max; $i++) {

            $resistModel = new Resistances();

            // Get resistances from Tyradex API
            $responseRes = Http::get('https://tyradex.vercel.app/api/v1/pokemon/'. $i);
            $resistances = $responseRes->json();

            $pokemon = Pokemon::where('id', $resistances['pokedex_id'])->first();

            if ($pokemon) {
                foreach ($resistances["resistances"] as $resistance) {
                    if ($resistance["name"] == "Normal") $resistModel->normal = $resistance["multiplier"];
                    if ($resistance["name"] == "Plante") $resistModel->plante = $resistance["multiplier"];
                    if ($resistance["name"] == "Feu") $resistModel->feu = $resistance["multiplier"];
                    if ($resistance["name"] == "Eau") $resistModel->eau = $resistance["multiplier"];
                    if ($resistance["name"] == "Électrik") $resistModel->electrik = $resistance["multiplier"];
                    if ($resistance["name"] == "Glace") $resistModel->glace = $resistance["multiplier"];
                    if ($resistance["name"] == "Combat") $resistModel->combat = $resistance["multiplier"];
                    if ($resistance["name"] == "Poison") $resistModel->poison = $resistance["multiplier"];
                    if ($resistance["name"] == "Sol") $resistModel->sol = $resistance["multiplier"];
                    if ($resistance["name"] == "Vol") $resistModel->vol = $resistance["multiplier"];
                    if ($resistance["name"] == "Psy") $resistModel->psy = $resistance["multiplier"];
                    if ($resistance["name"] == "Insecte") $resistModel->insecte = $resistance["multiplier"];
                    if ($resistance["name"] == "Roche") $resistModel->roche = $resistance["multiplier"];
                    if ($resistance["name"] == "Spectre") $resistModel->spectre = $resistance["multiplier"];
                    if ($resistance["name"] == "Dragon") $resistModel->dragon = $resistance["multiplier"];
                    if ($resistance["name"] == "Ténèbres") $resistModel->tenebres = $resistance["multiplier"];
                    if ($resistance["name"] == "Acier") $resistModel->acier = $resistance["multiplier"];
                    if ($resistance["name"] == "Fée") $resistModel->fee = $resistance["multiplier"];
                }
                $resistModel->pokemon_id = $pokemon->id;
                $resistModel->save();
                echo 'Resistance added for pokemon ' . $pokemon->name . 'with id=' . $pokemon->id . PHP_EOL;
            } else {
                dd("Pokemon not found.");
            }
        }
    }
}
