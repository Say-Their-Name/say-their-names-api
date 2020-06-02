<?php

namespace App\Imports;

use App\Models\Person;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PersonImporter implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $person = new Person([
            'full_name' => $row['name'],
            'date_of_incident' => $row['date_of_incident'],
            'number_of_children' => $row['number_of_children'],
            'age' => $row['age'],
            'city' => $row['city'],
            'country' => $row['country'],
            'biography' => null,
            'context' => $row['context'],
            'status' => 1,
        ]);
        return $person;
    }
}
