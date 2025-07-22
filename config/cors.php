<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Aquí podés configurar los orígenes, métodos y headers permitidos para
    | solicitudes CORS. Esto es útil si tu frontend está en otro dominio.
    |
    */

    'paths' => ['api/*', 'graphql'],

    'allowed_methods' => ['*'], // Podés limitar a ['GET', 'POST', etc.]

    'allowed_origins' => ['*'], // En producción, reemplazá '*' por el dominio del frontend

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // O limitá a ['Authorization', 'Content-Type']

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];
