<?php
echo "index";

echo $this->Bs4->navbar([
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
]);
debug($this);