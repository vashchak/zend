<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
       // $this->view->jQuery()->addStylesheet("http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css");
       // $this->view->jQuery()->addStylesheet("http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/ui-lightness/jquery-ui.css");  
        //$form = new Application_Form_JQueryForm;
       // $this-> viev-> form = $form;
        // Создаём объект нашей модели
        $movies = new Application_Model_DbTable_Movies(); 
        //* Применяем метод fetchAll для выборки всех записей из таблицы,
        // и передаём их в view, через следующую запи
        $this-> view-> movies = $movies->fetchAll();
    }

    public function addAction()
    {
        if(Zend_Auth::getinstance()->hasIdentity())
        {
            // Создаём форму
            $form = new Application_Form_Movie();

            // Указываем текст для submit
            $form->submit->setLabel('Добавить');

            // Передаём форму в view
            $this->view->form = $form;

            // Если к нам идёт Post запрос
            if ($this->getRequest()->isPost()) {
                // Принимаем его
                $formData = $this->getRequest()->getPost();

                // Если форма заполнена верно
                if ($form->isValid($formData)) {
                    // Извлекаем режиссёра
                    $director = $form->getValue('director');

                    // Извлекаем название фильма
                    $title = $form->getValue('title');

                    // Создаём объект модели
                    $movies = new Application_Model_DbTable_Movies();

                    // Вызываем метод модели addMovie для вставки новой записи
                    $movies->addMovie($director, $title);

                    // Используем библиотечный helper для редиректа на action = index
                    $this->_helper->redirector('index');
                } else {
                    // Если форма заполнена неверно,
                    // используем метод populate для заполнения всех полей
                    // той информацией, которую ввёл пользователь
                    $form->populate($formData);
                }
            }
        }  else {
            $this->_helper->redirector('login','auth');
        }
    }

    public function editAction()
    {
            // Создаём форму
            $form = new Application_Form_Movie();

            // Указываем текст для submit
            $form->submit->setLabel('Сохранить');
            $this->view->form = $form;

            // Если к нам идёт Post запрос
            if ($this->getRequest()->isPost()) {
                // Принимаем его
                $formData = $this->getRequest()->getPost();

                // Если форма заполнена верно
                if ($form->isValid($formData)) {
                    // Извлекаем id
                    $id = (int)$form->getValue('id');

                    // Извлекаем режиссёра
                    $director = $form->getValue('director');

                    // Извлекаем название фильма
                    $title = $form->getValue('title');

                    // Создаём объект модели
                    $movies = new Application_Model_DbTable_Movies();

                    // Вызываем метод модели updateMovie для обновления новой записи
                    $movies->updateMovie($id, $director, $title);

                    // Используем библиотечный helper для редиректа на action = index
                    $this->_helper->redirector('index');
                } else {
                    $form->populate($formData);
                }
            } else {
                // Если мы выводим форму, то получаем id фильма, который хотим обновить
                $id = $this->_getParam('id', 0);
                if ($id > 0) {
                    // Создаём объект модели
                    $movies = new Application_Model_DbTable_Movies();
                    // Заполняем форму информацией при помощи метода populate
                    $form->populate($movies->getMovie($id));
                }
            }
    }

    public function deleteAction()
    {
        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {
            // Принимаем значение
            $del = $this->getRequest()->getPost('del');

            // Если пользователь подтвердил своё желание удалить запись
            if ($del == 'Да') {
                // Принимаем id записи, которую хотим удалить
                $id = $this->getRequest()->getPost('id');

                // Создаём объект модели
                $movies = new Application_Model_DbTable_Movies();

                // Вызываем метод модели deleteMovie для удаления записи
                $movies->deleteMovie($id);
            }

            // Используем библиотечный helper для редиректа на action = index
            $this->_helper->redirector('index');
        } else {
            // Если запрос не Post, выводим сообщение для подтверждения
            // Получаем id записи, которую хотим удалить
            $id = $this->_getParam('id');

            // Создаём объект модели
            $movies = new Application_Model_DbTable_Movies();

            // Достаём запись и передаём в view
            $this->view->movie = $movies->getMovie($id);
        }
    }

    public function aboutAction()
    {
        $message = $this->_getParam('m');
      
        if ($message) {
            $this->view->message = $message;
        } else {
            $this->view->message = "no message";
        }
        // action body
    }


}



