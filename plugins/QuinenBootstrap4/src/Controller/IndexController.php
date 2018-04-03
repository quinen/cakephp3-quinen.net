<?php
namespace QuinenBootstrap4\Controller;

use QuinenBootstrap4\Controller\AppController;

class IndexController extends AppController
{

    public function index()
    {
        $layout = $this->request->getQuery('layout');

        $this->viewBuilder()->layout($layout);


    }
}