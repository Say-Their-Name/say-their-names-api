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
            'source_logo' => 'https://vignette.wikia.nocookie.net/logopedia/images/5/52/CNN_%282014%29.svg/revision/latest/scale-to-width-down/200?cb=20180509053533',
            'source_link'=> 'http://edition.cnn.com',
        ]
    ];
}
