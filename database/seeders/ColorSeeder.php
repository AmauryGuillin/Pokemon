<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'Insecte', 'value' => '#A7B723'],
            ['name' => 'Ténèbres', 'value' => '#75574C'],
            ['name' => 'Dragon', 'value' => '#7037FF'],
            ['name' => 'Électrik', 'value' => '#F9CF30'],
            ['name' => 'Fée', 'value' => '#E69EAC'],
            ['name' => 'Combat', 'value' => '#C12239'],
            ['name' => 'Feu', 'value' => '#F57D31'],
            ['name' => 'Vol', 'value' => '#A891EC'],
            ['name' => 'Spectre', 'value' => '#70559B'],
            ['name' => 'Normal', 'value' => '#AAA67F'],
            ['name' => 'Plante', 'value' => '#74CB48'],
            ['name' => 'Sol', 'value' => '#DEC16B'],
            ['name' => 'Glace', 'value' => '#9AD6DF'],
            ['name' => 'Poison', 'value' => '#A43E9E'],
            ['name' => 'Psy', 'value' => '#FB5584'],
            ['name' => 'Roche', 'value' => '#B69E31'],
            ['name' => 'Acier', 'value' => '#B7B9D0'],
            ['name' => 'Eau', 'value' => '#6493EB'],
        ];


        foreach ($colors as $color) {
            $newColor = new Color();

            $newColor->name = $color['name'];
            $newColor->value = $color['value'];

            $newColor->save();

            echo "color : " . $newColor->name . " added" . "\n";
        }

        echo 'All colors successfully added to DB.';
    }
}
