<?php
return array(
    '^([a-z]+)$' => '$1/index',
    '^([a-z]+)/([0-9]+)' => '$1/view/$2',
    '^$' => 'main/index',
//    'news' => 'news/index',
//    'news/([0-9]+)' => 'news/view/$1',

);