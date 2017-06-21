<?php

return [
    'middlewares' => [
        'additional' => [],
        'replacement' => ['wala.jwt.header.parser', 'wala.jwt.header.validation', 'auth.db.overwrite']
    ]
];
