<?php

use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['daily'],
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path(sprintf('logs/emails-%s.log', date('Y-m-d'))),
            'level' => strtolower(env("APP_LOG_LEVEL", 'debug')),
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path(sprintf('logs/emails-%s.log', date('Y-m-d'))),
            'level' => strtolower(env("APP_LOG_LEVEL", 'debug')),
            'days' => 14,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'path' => storage_path(sprintf('logs/emails-%s.log', date('Y-m-d'))),
            'username' => 'Lumen Log',
            'emoji' => ':boom:',
            'level' => strtolower(env("APP_LOG_LEVEL", 'critical')),
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => strtolower(env("APP_LOG_LEVEL", 'debug')),
            'handler' => SyslogUdpHandler::class,
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
            ],
        ],

        'stderr' => [
            'driver' => 'monolog',
            'handler' => StreamHandler::class,
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => strtolower(env("APP_LOG_LEVEL", 'debug')),
            'path' => storage_path(sprintf('logs/emails-%s.log', date('Y-m-d'))),
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => strtolower(env("APP_LOG_LEVEL", 'debug')),
            'path' => storage_path(sprintf('logs/emails-errors-%s.log', date('Y-m-d'))),
        ],
    ],

];
