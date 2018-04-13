<?php
$menu = [
    [
        'icon' => "home",
        'text' => "Accueil"
    ],
    [
        'icon' => "cubes",
        'text' => "Projets",
        'menu' => [
            [
                'icon' => "child",
                'text' => "Prenoms"
            ]
        ]
    ]
];
echo $this->Bs4->navbar($menu);
debug($this);