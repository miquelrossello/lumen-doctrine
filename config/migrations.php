<?php

return [
    /* ENTITY MANAGER */
    'default' => [
        'table' => 'migrations',
        'directory' => database_path('migrations'),
        'organize_migrations' => 'false',
        'namespace' => 'Database\\Migrations',
        'version_column_length' => 15
    ]
];
