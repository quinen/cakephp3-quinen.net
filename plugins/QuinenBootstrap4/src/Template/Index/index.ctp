<?php

$layouts = ['starter'];

$urls = collection($layouts)->map(function($layout){
    return [
        'text' => $layout,
        'link' => [
            'plugin'=>$this->plugin,
            'controller'=>$this->name,
            'layout'=> $layout
        ]
    ];
});
$url[] = "texte simple";
echo $layout;
echo $this->Bs4->ul($urls);
echo $this->Html->nestedList($urls->toArray());

echo $this->Bs4->row([
    $this->Bs4->card("This is some text within a card body.",[
        'header' => "header",
        'footer' => "footer"
    ]),
    $this->Bs4->navTabs(
        [
            [
                'tab' => "Home",
                'content' => "Home content"
            ],
            [
                'tab' => "Profile",
                'content' => "Profile content"
            ],
            [
                'tab' => "Contact",
                'content' => "Contact content"
            ],
        ]
    )
]);

echo $this->Bs4->navbar([
    [
        'brand' => "Brand",
        "link" => "/"
    ]
]);