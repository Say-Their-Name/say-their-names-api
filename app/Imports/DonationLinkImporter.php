<?php

namespace App\Imports;

use App\Models\DonationLinks;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DonationLinkImporter implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new DonationLinks([
            'title' => $row['title'],
            'description' => $row['description'],
            'link' => $row['link'],
            'outcome' => null,
            'banner_img_url' => 'https://say-their-names.fra1.cdn.digitaloceanspaces.com/petition.png',
            'outcome_img_url' => 'https://say-their-names.fra1.cdn.digitaloceanspaces.com/petition.png',
            'status' => 1,
        ]);
    }
}
