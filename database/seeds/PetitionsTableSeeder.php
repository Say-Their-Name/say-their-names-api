<?php

use App\Models\PetitionLink;
use App\Models\Statics\PetitionLinkTypes;
use App\Models\Statics\StaticText;
use Illuminate\Database\Seeder;
use Tapp\Airtable\Facades\AirtableFacade;

class PetitionsTableSeeder extends Seeder
{
    public function run()
    {
        $airtableDonations = AirtableFacade::table('petitions')->all();

        foreach ($airtableDonations as $donation) {
            PetitionLink::create([
                'title' => $donation['fields']['TITLE'],
                'description' => $donation['fields']['DESCRIPTION'],
                'link' => $donation['fields']['LINK'],
                'outcome' => isset($donation['fields']['OUTCOME']) ? $donation['fields']['OUTCOME'] : StaticText::CONTRIBUTION_TEXT,
                'banner_img_url' => $donation['fields']['IMAGE'],
                'outcome_img_url' => $donation['fields']['OUTCOME IMAGE'],
                'type_id' => PetitionLinkTypes::FOR_POLICY,
                'status' => 1,
            ]);
        }
    }
}
