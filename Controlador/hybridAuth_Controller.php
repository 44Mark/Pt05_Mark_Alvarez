<?php
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