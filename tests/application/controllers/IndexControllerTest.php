<?php

class IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testIndexAction()
    {
        $params = array('action' => 'index', 'controller' => 'Index', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        
        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
        $this->assertQueryContentContains("div#welcome h3", "This is your project's main page");
    }

    public function testAddAction()
    {
        $params = array('action' => 'add', 'controller' => 'Index', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        
        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
        $this->assertQueryContentContains(
            'div#view-content p',
            'View script for controller <b>' . $params['controller'] . '</b> and script/action name <b>' . $params['action'] . '</b>'
            );
    }

    public function testDeleteAction()
    {
        $params = array('action' => 'delete', 'controller' => 'Index', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        
        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
        $this->assertQueryContentContains(
            'div#view-content p',
            'View script for controller <b>' . $params['controller'] . '</b> and script/action name <b>' . $params['action'] . '</b>'
            );
    }

    public function testAboutAction()
    {
        $params = array('action' => 'about', 'controller' => 'Index', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        
        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
        $this->assertQueryContentContains(
            'div#view-content p',
            '<h2 id="message">'
            );
    }
    
    public function testAboutNoMessegeAction()
    {
        $params = array('action'=>'about','controller'=>'Index','module'=>'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        
        $this->assertModule($urlParams['module']);
        $this->assertAction($urlParams['action']);
        $this->assertController($urlParams['controller']);
        
        $this->assertResponseCode(200);
        
        $this->assertQueryCount('#message',1);
        $this->assetQueryContentContains('#messege', 'no messege');
    }
    
    public function testAboutQoqMessegeAction()
    {
        $params = array('action'=>'about','controller'=>'Index','module'=>'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        
        $this->assertModule($urlParams['module']);
        $this->assertAction($urlParams['action']);
        $this->assertController($urlParams['controller']);
        
        $this->assertResponseCode(200);
        
        $this->assertQueryCount('#message',1);
        $this->assetQueryContentContains('#messege', 'qoq');
    }
    
}









