<?php

return [
    'bot_token'         => env('SLACK_BOT_TOKEN'),
    'default_channel'   => env('SLACK_DEFAULT_CHANNEL', '#general'),
    'role'              => env('SLACK_ROLE', 'Default Role'),
];