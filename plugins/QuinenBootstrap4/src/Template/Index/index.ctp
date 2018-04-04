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