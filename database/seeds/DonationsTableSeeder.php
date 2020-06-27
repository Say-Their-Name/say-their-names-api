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
                    'description' => isset($donation['fields']['DESCRIPTION']) ? str_replace("\n\\n", '', $donation['fields']['DESCRIPTION']) : null,
                    'link' => $donation['fields']['LINK'],
                    'outcome' => isset($donation['fields']['OUTCOME']) ? str_replace("\n\\n", '', $donation['fields']['OUTCOME']) : null,
                    'banner_img_url' => isset($donation['fields']['IMAGE']) ? $donation['fields']['IMAGE'] : null,
                    'outcome_img_url' => isset($donation['fields']['OUTCOME IMAGE']) ? $donation['fields']['OUTCOME IMAGE'] : null,
                    'type_id' => DonationLinkTypes::firstOrCreate([
                        'type' => $donation['fields']['TYPE'],
                    ])->id,
                    'status' => 1,
                ]
            );
        }
    }
}
