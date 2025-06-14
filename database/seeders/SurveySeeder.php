<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use MattDaneshvar\Survey\Models\Survey;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $survey = Survey::create(['name' => 'Expression of Interest – Scouts Services Program', 'settings' => ['accept-guest-entries' => true]]);

        $one = $survey->sections()->create(['name' => 'Part One']);

        $one->questions()->create([
            'content' => 'How many cats do you have?',
            'type' => 'number',
            'rules' => ['numeric', 'min:0']
        ]);

        $two = $survey->sections()->create(['name' => 'Part Two']);

        $two->questions()->create([
            'content' => 'What\'s the name of your first cat?',
        ]);

        $two->questions()->create([
            'content' => 'Would you want a new cat?',
            'type' => 'radio',
            'options' => ['Yes', 'Oui']
        ]);
    }
}
