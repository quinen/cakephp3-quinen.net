<?php

$menu = [
    [
        'brand' => "Quinen.net",
        'link' => "/",

    ],
    [
        'icon' => "home",
        'text' => "Accueil"
    ],
    [
        'icon' => "briefcase",
        'text' => "CV",
        'menu' => [
            [
                'icon' => "globe",
                'text' => "Web"
            ],
            [
                'icon' => "file-pdf",
                'text' => "PDF"
            ]
        ]
    ],
    [
        'icon' => "cubes",
        'text' => "Applications",
        'menu' => [
            [
                'icon' => "child",
                'text' => "Prenoms"
            ],
            [
                'icon' => "chart-bar",
                'text' => "Tapis"
            ],
            [
                'icon' => "dolly", // inventory
                'text' => "Stock"
            ],
            [
                'icon' => "exchange-alt", // inventory
                'text' => "convertisseur RGB <-> HSL"
            ]
        ]
    ],
    [
        'icon' => "link",
        'text' => "Liens"
    ]
];
echo $this->Bs4->navbar($menu,[
    'class' => "fixed-top"
]);
echo $this->Html->tag('br');
echo $this->Html->tag('br');
echo $this->Html->tag('br');