<?php

$layouts = ['starter'];

$urls = collection($layouts)->map(function($layout){
    return $this->Html->link(
        $layout,
        ['plugin'=>$this->plugin,'controller'=>$this->name,'action'=> "layout".ucfirst($layout)]
    );
})->toArray();

echo $this->Bs4->ul($urls);