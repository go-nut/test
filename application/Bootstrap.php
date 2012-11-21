<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

  protected function _initHeadData()
  {
    $this->bootstrap('view');
    $view = $this->getResource('view');
    $view->doctype('XHTML1_STRICT');
    $view->headTitle('IMH Resource Status');
  }

  protected function _initNav()
  {
    $this->bootstrap('layout');
    $view = $this->getResource('layout')->getView();
    $config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav');

    $view->navigation(new Zend_Navigation($config));
  }

  protected function _initAutoload()
  {
    // Add autoloader empty namespace
    $autoLoader = Zend_Loader_Autoloader::getInstance();
    $resourceLoader = new Zend_Loader_Autoloader_Resource(array(
      'basePath' => APPLICATION_PATH,
      'namespace' => '',
      'resourceTypes' => array(
        'form' => array(
          'path' => 'forms/',
          'namespace' => 'Form_',
        )
      ),
    ));
    // Return it so that it can be stored by the bootstrap
    return $autoLoader;
  }

  protected function _initAll() {
    $this->bootstrap('db');

    Zend_Registry::set('db', $this->getResource('db'));

    // Handle any custom routing here
  }

}

