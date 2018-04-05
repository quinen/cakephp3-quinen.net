<?php

$layouts = ['starter'];

$urls = collection($layouts)->map(function($layout){
    return $this->Html->link(
        $layout,
        ['plugin'=>$this->plugin,'controller'=>$this->name,'layout'=> $layout]
    );
});
echo $layout;
echo $this->Bs4->ul($urls);
echo $this->Html->nestedList($urls->toArray());
echo $this->Bs4->card("This is some text within a card body.",[
    'header' => "header",
    'footer' => "footer"
]);

echo '<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">Home content</div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">Profile content</div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">Contact content</div>
</div>';

echo $this->Bs4->navTabs(
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
);