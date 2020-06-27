<?php

use App\Models\PetitionLink;
use App\Models\Statics\PetitionLinkTypes;
use Illuminate\Database\Seeder;
use Tapp\Airtable\Facades\AirtableFacade;

class PetitionsTableSeeder extends Seeder
{
    public function run()
    {
        $airtablePetitions = AirtableFacade::table('petitions')->all();

        foreach ($airtablePetitions as $petition) {
            PetitionLink::updateOrCreate(
                ['title' => $petition['fields']['TITLE'] ],
                [
                    'description' => str_replace("\n\\n", '', $petition['fields']['DESCRIPTION']),
                    'link' => $petition['fields']['LINK'],
                    'outcome' => isset($petition['fields']['OUTCOME']) ? str_replace("\n\\n", '', $petition['fields']['OUTCOME']) : null,
                    'banner_img_url' => isset($petition['fields']['IMAGE']) ? $petition['fields']['IMAGE'] : null,
                    'outcome_img_url' => isset($petition['fields']['OUTCOME IMAGE']) ? $petition['fields']['OUTCOME IMAGE'] : null,
                    'type_id' => PetitionLinkTypes::firstOrCreate([
                        'type' => $petition['fields']['TYPE'],
                    ])->id,
                    'status' => 1,
                ]
            );
        }
    }
}
