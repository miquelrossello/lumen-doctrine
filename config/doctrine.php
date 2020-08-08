<?php

return [
  'managers' => [
      'default' => [
          'dev'        => env('APP_DEBUG', true),
          'connection' => env('DB_CONNECTION', 'mysql'),
          'meta' => 'xml',
          'namespaces' => [
              'User' => 'App\Domain\User\User'
          ],
          'paths' => [
              base_path('app') . '/Infrastructure/Persistence/Doctrine'
          ],
          'repository' => Doctrine\ORM\EntityRepository::class,
          'proxies'    => [
              'namespace'     => false,
              'path'          => storage_path('proxies'),
              'auto_generate' => env('DOCTRINE_PROXY_AUTOGENERATE', false)
          ],
          /*
          |--------------------------------------------------------------------------
          | Doctrine events
          |--------------------------------------------------------------------------
          |
          | The listener array expects the key to be a Doctrine event
          | e.g. Doctrine\ORM\Events::onFlush
          |
          */
          'events'     => [
              'listeners'   => [],
              'subscribers' => []
          ],
          'filters'    => []
      ],
    ],
  /*
  |--------------------------------------------------------------------------
  | Doctrine custom types
  |--------------------------------------------------------------------------
  */
  'custom_types'              => [
      'json' => LaravelDoctrine\ORM\Types\Json::class
  ],
  /*
  |--------------------------------------------------------------------------
  | DQL custom datetime functions
  |--------------------------------------------------------------------------
  */
  'custom_datetime_functions' => [],
  /*
  |--------------------------------------------------------------------------
  | DQL custom numeric functions
  |--------------------------------------------------------------------------
  */
  'custom_numeric_functions'  => [],
  /*
  |--------------------------------------------------------------------------
  | DQL custom string functions
  |--------------------------------------------------------------------------
  */
  'custom_string_functions'   => [],
  /*
  |--------------------------------------------------------------------------
  | Register custom hydrators
  |--------------------------------------------------------------------------
  */
  'custom_hydration_modes'     => [
      // e.g. 'hydrationModeName' => MyHydrator::class,
  ],
  /*
  |--------------------------------------------------------------------------
  | Enable query logging with laravel file logging,
  | debugbar, clockwork or an own implementation.
  | Setting it to false, will disable logging
  |
  | Available:
  | - LaravelDoctrine\ORM\Loggers\LaravelDebugbarLogger
  | - LaravelDoctrine\ORM\Loggers\ClockworkLogger
  | - LaravelDoctrine\ORM\Loggers\FileLogger
  |--------------------------------------------------------------------------
  */
  'logger'                    => env('DOCTRINE_LOGGER', false),
  /*
  |--------------------------------------------------------------------------
  | Cache
  |--------------------------------------------------------------------------
  |
  | Configure meta-data, query and result caching here.
  | Optionally you can enable second level caching.
  |
  | Available: acp|array|file|memcached|redis
  |
  */
  'cache'                     => [
      'second_level'     => false,
      'default'          => env('DOCTRINE_CACHE', 'array'),
      'namespace'        => null,
      'metadata'         => [
          'driver'       => env('DOCTRINE_METADATA_CACHE', env('DOCTRINE_CACHE', 'array')),
          'namespace'    => null,
      ],
      'query'            => [
          'driver'       => env('DOCTRINE_QUERY_CACHE', env('DOCTRINE_CACHE', 'array')),
          'namespace'    => null,
      ],
      'result'           => [
          'driver'       => env('DOCTRINE_RESULT_CACHE', env('DOCTRINE_CACHE', 'array')),
          'namespace'    => null,
      ],
  ],
  /*
  |--------------------------------------------------------------------------
  | Gedmo extensions
  |--------------------------------------------------------------------------
  |
  | Settings for Gedmo extensions
  | If you want to use this you will have to require
  | laravel-doctrine/extensions in your composer.json
  |
  */
  'gedmo'                     => [
      'all_mappings' => false
  ]
];
