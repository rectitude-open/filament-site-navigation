<?php

declare(strict_types=1);

return [
    'nav' => [
        'label' => 'Navigácia stránky',
        'group' => 'Obsah',
    ],
    'field' => [
        'title' => 'Názov',
        'path' => 'Cesta',
        'active_status' => 'Stav aktivity',
        'active_status_active' => 'Aktívny',
        'active_status_inactive' => 'Neaktívny',
        'visibility_status' => 'Stav viditeľnosti',
        'visibility_status_visible' => 'Viditeľný',
        'visibility_status_hidden' => 'Skrytý',
        'controller_action' => 'Akcia kontrolóra',
        'route_parameters' => 'Parametre trasy',
        'child_routes' => 'Podradené trasy',
    ],
    'info' => [
        'route_configuration' => 'Konfigurácia trasy',
        'route_parameters_key_label' => 'Kľúč parametra',
        'route_parameters_value_label' => 'Hodnota parametra',
        'child_routes_key_label' => 'Vzor trasy',
        'child_routes_value_label' => 'Akcia kontrolóra',
    ],
    'resource' => [
        'label' => 'Navigácia stránky',
    ],
];
