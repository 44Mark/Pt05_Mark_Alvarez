<?php
// Dades creades a GitHub per a l'autenticació de HybrudAuth
return [
    'callback' => 'http://markalvarez.cat/Controlador/hybridAuth.php?provider=GitHub',
    'providers' => [
        'GitHub' => [
            'enabled' => true,
            'keys' => [
                'id' => GITHUB_CLIENT_ID,
                'secret' => GITHUB_CLIENT_SECRET,
            ],
        ],
    ],
];
?>