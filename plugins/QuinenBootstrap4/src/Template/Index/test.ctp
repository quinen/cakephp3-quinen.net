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

/*
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
echo $this->Html->tag('i',"",['class'=>"fas fa-user"]);
echo $this->Bs4->button('add');
echo $this->Bs4->button();
*/
echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
</nav>';
echo $this->Bs4->navbar([
    [
        'brand' => "Navbar",
        'link' => "#"
    ],
    //*
    [
        'text' => "Home",
        'isActive' => true,
        'link' => "#"
    ],
    /*
    [
        'text' => "Link",
        'link' => "#"
    ],
    [
        'text' => "Dropdown",
        'link' => "#",
        'menu' => [
            [
                'text' => "Action",
                'link' => "#"
            ],
            [
                'text' => "Another action",
                'link' => "#"
            ],
            [
                'text' => "-"
            ],
            [
                'text' => "Something else here",
                'link' => "#"
            ],
            [
                'text' => "Disabled",
                'link' => "#",
                'isDisabled' => true
            ],
        ]
    ]
    */
],[
    'hasToggle' => true
]);