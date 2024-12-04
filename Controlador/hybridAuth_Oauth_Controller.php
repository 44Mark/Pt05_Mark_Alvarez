<?php
// Configuración básica de HybridAuth
return [
    'providers' => [
        'GitHub' => [
            'enabled' => true,
            'keys' => [
                'id' => GITHUB_CLIENT_ID,
                'secret' => GITHUB_CLIENT_SECRET,
            ],
            'callback' => 'https://localhost/Controlador/hybridAuth.php?provider=GitHub', 
        ],
        'Google' => [
            'enabled' => true,
            'keys' => [
                'id' => GOOGLE_CLIENT_ID,
                'secret' => GOOGLE_CLIENT_SECRET,
            ],
            'scope' => 'email', // Permite obtener el correo electrónico del usuario
            'callback' => 'https://localhost/Controlador/oAuth.php?provider=Google',
        ],
    ],
];
?>