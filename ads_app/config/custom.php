<?php

return [
    'jwt_key' => env('TOKEN_KEY', 'token'),
    'jwt_expire_minute_refresh' => env('JWT_EXPIRE_MINUTE_REFRESH', 5)
];
