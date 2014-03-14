<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initAcl()
    {
        // Создаём объект Zend_Acl
        $acl = new Zend_Acl();
        
        // Добавляем ресурсы нашего сайта,
        // другими словами указываем контроллеры и действия
        
        // указываем, что у нас есть ресурс index
        $acl->addResource('index');
        
        // ресурс add является потомком ресурса index
        $acl->addResource('add', 'index');
        
        // ресурс edit является потомком ресурса index
        $acl->addResource('edit', 'index');
        
        // ресурс delete является потомком ресурса index
        $acl->addResource('delete', 'index');
        
        // указываем, что у нас есть ресурс error
        $acl->addResource('error');
        
        // указываем, что у нас есть ресурс auth
        $acl->addResource('auth');
        
        // ресурс login является потомком ресурса auth
        $acl->addResource('login', 'auth');
        
        // ресурс logout является потомком ресурса auth
        $acl->addResource('logout', 'auth');
        
        // далее переходим к созданию ролей, которых у нас 2:
        // гость (неавторизированный пользователь)
        $acl->addRole('guest');
        
        // администратор, который наследует доступ от гостя
        $acl->addRole('admin', 'guest');
        
        // разрешаем гостю просматривать ресурс index
        $acl->allow('guest', 'index', array('index'));
        
        // разрешаем гостю просматривать ресурс auth и его подресурсы
        $acl->allow('guest', 'auth', array('index', 'login', 'logout'));
        
        // даём администратору доступ к ресурсам 'add', 'edit' и 'delete'
        $acl->allow('admin', 'index', array('add', 'edit', 'delete'));
        
        // разрешаем администратору просматривать страницу ошибок
        $acl->allow('admin', 'error');
        
        // получаем экземпляр главного контроллера
        $fc = Zend_Controller_Front::getInstance();
        
        // регистрируем плагин с названием AccessCheck, в который передаём
        // на ACL и экземпляр Zend_Auth
        $fc->registerPlugin(new Application_Plugin_AccessCheck($acl, Zend_Auth::getInstance()));
    }
}

