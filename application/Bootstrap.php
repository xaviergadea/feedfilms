<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }
    
    protected function _initFrontRegistry()
    {
    	$front = $this->bootstrap('frontController')->getResource('frontController');
    	$front->setParam('registry', $this->getContainer());
    }
    
	protected function _initConfig()
    {
        $config = new Zend_Config_Ini(
                APPLICATION_PATH.'/configs/application.ini',
                APPLICATION_ENV);
        Zend_Registry::set('uploadDirectory', $config->uploadDirectory);        
    }
    /**
     * Bootstrap the view
     *
     * @return void
     */
    protected function _initView()
    {
    	// Initialize view
    	$this->bootstrap('layout');
    	$layout = $this->getResource('layout');
    	$view = $layout->getView();
    
    	$view->doctype('XHTML1_TRANSITIONAL');
    	$view->headTitle('');
    
    	// Enable dojo on layout
    	$view->addHelperPath('/helps/Form/Element', 'Zend_View_Helps_Form_Element');
    	$view->addBasePath(APPLICATION_PATH . '/views');
    
    	// Return it, so that it can be stored by the bootstrap
    	return $view;
    }
}

