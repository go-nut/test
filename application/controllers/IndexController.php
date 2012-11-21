<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
      return;
      $login = new Form_LoginForm();
      $request = $this->getRequest();
      if ($request->isPost()) {
          $data = $request->getParams();
        if ($form->isValid($data)) {
          $adapter = new Zend_Auth_Adapter_DbTable (
            Zend_Db_Table::getDefaultAdapter(),
            'users',
            'username',
            'password',
            'MD5(CONCAT(?, password_salt))'
          );

          $adapter->setIdentity($form->getValue('username'));
          $adapter->setCredential($form->getValue('password'));
          
          $auth = Zend_Auth::getInstance();
          $result = $auth->authenticate($adapter);
          if ($result->isValid()) {
            $this->_helper->FlashMessenger('Logged In');
            $this->_redirect('/');
            return;
          } else {
            $this->_helper->FlashMessenger('Not Logged In');
            $this->_redirect('/');
            exit;
          }
        }
      }
      $this->_redirect('/');
      exit;
    }

    public function testAction()
    {
    }
}

