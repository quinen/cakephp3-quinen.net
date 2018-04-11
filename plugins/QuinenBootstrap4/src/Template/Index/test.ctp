<?php
/*
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
    ],
    [
        'text' => "Home",
        'link' => "/"
    ],
    [
        'text' => "Bs4",
        'link' => [
            'plugin' => "QuinenBootstrap4",
            'controller' => "Index"
        ]    
    ],
    [
        'text' => "menu",
        'menu' => [
            [
                'text' => "element 1"
            ],
            [
                'text' => "element 2"
            ],
            [
                'text' => "element 3"
            ]
        ]
    ]

]);
*/
echo '<div class="dropdown show">
<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Dropdown link
</a>

<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
  <a class="dropdown-item" href="#">Action</a>
  <a class="dropdown-item" href="#">Another action</a>
  <a class="dropdown-item" href="#">Something else here</a>
</div>
</div>';

echo $this->Bs4->dropdown([
    'text' => "Dropdown link",
    'button' => "secondary",
    'menu' => [
        [
            'text' => "Action",
            'link' => "#"
        ],
        [
            'text' => "Another Action",
            'link' => "#"
        ],
        [
            'text' => "Something else here",
            'link' => "#"
        ]
    ]
]);
//*/
echo $this->Html->tag('i',"",['class'=>"fas fa-user"]);
echo $this->Bs4->button('add');
echo $this->Bs4->button();