<?php

use App\Models\DonationLink;
use App\Models\Statics\DonationLinkTypes;
use App\Models\Statics\StaticText;
use Illuminate\Database\Seeder;
use Tapp\Airtable\Facades\AirtableFacade;

class DonationsTableSeeder extends Seeder
{
    public function run()
    {
        $airtableDonations = AirtableFacade::table('donations')->all();

        foreach ($airtableDonations as $donation) {
            DonationLink::updateOrCreate(
                ['title' => $donation['fields']['TITLE'] ],
                [
                    'description' => isset($donation['fields']['DESCRIPTION']) ? $donation['fields']['DESCRIPTION'] : null,
                    'link' => $donation['fields']['LINK'],
                    'outcome' => isset($donation['fields']['OUTCOME']) ? $donation['fields']['OUTCOME'] : null,
                    'banner_img_url' => $donation['fields']['IMAGE'],
                    'outcome_img_url' => $donation['fields']['OUTCOME IMAGE'],
                    'type_id' => DonationLinkTypes::MOVEMENT,
                    'status' => 1,
                ]
            );
        }
    }
}
