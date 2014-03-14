<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        
        /* Initialize action controller here */
    }

   public function indexAction()
{
    // Создаём объект нашей модели
    $movies = new Application_Model_DbTable_Movies();

    // Применяем метод fetchAll для выборки всех записей из таблицы,
    // и передаём их в view, через следующую запись
    $this->view->movies = $movies->fetchAll();
}


    public function addAction()
    {
        // action body
    }
    
    public function editAction()
    {
    	// action body
    }


}