<?php
/**
 *  
 */
namespace QuinenBootstrap4\Controller;

use QuinenBootstrap4\Controller\AppController;
/**
 * 
 */
class IndexController extends AppController
{

    /**
     * Index action
     * 
     * @return void
     */
    public function index()
    {
        $this->_test();
    }

    /**
     * Test method
     * 
     * @return void
     */
    private function _test()
    {
        $layout = $this->request->getQuery('layout', 'default');

        $this->Flash->success("test de success");
        $this->Flash->error("test de error");
        $this->Flash->info("test de info");
        $this->Flash->warning("test de warning");
        //$this->Flash->toto("test de toto");

        //debug($_SESSION);
        //$this->viewBuilder()->layout($layout);
        $this->set(compact('layout'));
    }
}