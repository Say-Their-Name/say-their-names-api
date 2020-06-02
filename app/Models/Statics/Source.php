<?php

namespace App\Models\Statics;

use App\Models\Traits\Unguarded;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Source extends Model
{
    use Unguarded;
    use Sushi;

    protected $hidden = [
        'rss_feed_url',
    ];

    protected $rows = [
        [
            'id' => 1,
            'name' => 'CNN',
            'rss_feed_url' => 'https://edition.cnn.com/services/rss/',
            'source_logo' => 'https://lorempixel.com/640/480/?28870',
            'source_link'=> 'http://edition.cnn.com',
        ]
    ];
}
