<?php

namespace App\Models\Objects;

use Spatie\DataTransferObject\DataTransferObject;

class SharableLinks extends DataTransferObject
{
    public $base;
    public $facebook;
    public $twitter;
    public $whatsapp;
}
