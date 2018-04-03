<?php
    namespace QuinenBootstrap4\Controller;

    use QuinenBootstrap4\Controller\AppController;

    class IndexController extends AppController
    {

        public function index(){

        }

        public function layoutStarter(){
            $this->setLayout('starter');
        }
    }