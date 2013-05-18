<?php
/**
 * Application bootstrap
 *
 * @uses    Zend_Application_Bootstrap_Bootstrap
 * @package Iptours
 * @version SVN $Id: Bootstrap.php 1457 2010-07-06 10:33:27Z agustincl $
 */

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
 {
        
        //private $_acl=null;
        
        protected function _initAutoload()
    {
        
        $autoloader = Zend_Loader_Autoloader::getInstance();
//        Zend_Debug::dump($autoloader->getRegisteredNamespaces());
//        Zend_Debug::dump(get_include_path());
                //$autoloader->setFallbackAutoloader(true);
        
    }

 
        protected function _initFrontRegistry()
    {
         $front = $this->bootstrap('frontController')->getResource('frontController');
         $front->setParam('registry', $this->getContainer());         
    }
    
    protected function _initErrors()
    {
        $front = Zend_Controller_Front::getInstance();
                $front->registerPlugin(new Zend_Controller_Plugin_ErrorHandler());
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
        $view->addHelperPath('Zend/Dojo/View/Helper/', 'Zend_Dojo_View_Helper');
        $view->addHelperPath(APPLICATION_PATH . '/views/helpers', 'Zend_View_Helper_NavMenu');
        $view->addHelperPath(APPLICATION_PATH . '/views/helpers', 'Zend_View_Helper_AclLink');
        $view->addHelperPath(APPLICATION_PATH . '/views/helpers', 'Zend_View_Helper_AdminTemplateDir');
        $view->addBasePath(APPLICATION_PATH . '/views'); 
        
        // Return it, so that it can be stored by the bootstrap
        return $view;
    }
    
    
        protected function _initDatabase()
        {
       $this->bootstrapDb();
       $db = $this->getResource('db');
       $db->setFetchMode(Zend_Db::FETCH_OBJ);
       $db->query("SET NAMES 'utf8'");
       $db->query("SET CHARACTER SET 'utf8'");
       Zend_Registry::set("db", $db);  
       
       return $db;
        }
        
        protected function _initLogguer()
        {
                // Firebug Logger
                $writer_firebug = new Zend_Log_Writer_Firebug();
                $logger_firebug = new Zend_Log($writer_firebug);
                Zend_Registry::set("logger_firebug", $logger_firebug); 
                
                // Stream Logger
                $writer_stream = new Zend_Log_Writer_Stream('php://output');
                $logger_screen = new Zend_Log($writer_stream);
        Zend_Registry::set("logger_screen", $logger_screen);  
                
                // File Logger
                $config = $this->getOptions();
                $writer_file = new Zend_Log_Writer_Stream($config['logFile']);
                $logger_file = new Zend_Log($writer_file);
                Zend_Registry::set("logger_file", $logger_file);

                // DB Logger
                $db=Zend_Registry::get('db');
                $columnMapping = array('error_level' => 'priority',
                                                           'message' => 'message'
                                                                );                                                                      
                $writer_db = new Zend_Log_Writer_Db($db, 'errors_log', $columnMapping);
                $logger_db = new Zend_Log($writer_db);
                Zend_Registry::set("logger_db", $logger_db);  
                return $logger_db;
        }
        
        protected function _initEmail()
        {      
                $emailconf = $this->getOption('email'); 
                $transport = new Zend_Mail_Transport_Smtp($emailconf['server'], $emailconf); 
        Zend_Registry::set("transport", $transport);      
        return $transport;
        }

    protected function _initSession()
    {
                Zend_Session::start();
                $zfip = new Zend_Session_Namespace('jan');
                
        }
                

     protected function _initLocale()
     {                  
        $locale = new Zend_Locale();
        $config = $this->getOptions();          
        $defaultLocale = $config['lang_local'];
        
 
        try {
            $locale = new Zend_Locale('auto');
        } catch (Zend_Locale_Exception $e) {
            $locale = new Zend_Locale($defaultLocale);
        }
        
        if(!isset($_SESSION['default']['locale']))
            $_SESSION['default']['locale']=$locale->getRegion();
        if(!isset($_SESSION['default']['language']))
            $_SESSION['default']['language']=$locale->getLanguage();
                Zend_Registry::set('Zend_Locale', $locale);
        
     }

     protected function _initLang()
     {
        // TODO
        // Set cache for speedup
        //$cache = Zend_Cache::factory('Core','File');
        //Zend_Translate::setCache($cache);

        $translate = new Zend_Translate('tmx', dirname(__FILE__) .'/languages/info.xml', $_SESSION['default']['language']);
                Zend_Registry::set('Zend_Translate', $translate);        
     }

    protected function _initNavigation()
    {
                //$this->bootstrap('layout');
        $config = $this->getOptions();
        $layout = $this->getResource('layout');
                $view = $layout->getView();
                $confignav = new Zend_Config_Xml($config['navigationMenu'], 'nav');
                //Zend_Debug::dump($confignav);
                $container = new Zend_Navigation($confignav);   
                $view->navigation($container);

/*              $router = Zend_Controller_Front::getInstance()->getRouter();
        $fake_route = new Zend_Controller_Request_Http();
        $fake_route->setRequestUri('/');
        $router->route($fake_route);
        */      
        }

        protected function _initGoogleMap()
    {
                $gmap = $this->getOption('maps'); 
        Zend_Registry::set("APIKey", $gmap['APIKey']);      
    }   
        
        protected function _initRoutes() 
    {
        $router = $this->bootstrap('frontController')->getResource('frontController')->getRouter();
                $route = new Zend_Controller_Router_Route_Static(
                    'index.php',
                    array('module'=>'default', 'controller' => 'index', 'action' => 'index')
                );
                $router->addRoute('index', $route);
        
        $route  = new Zend_Controller_Router_Route_Regex(
            '^(blog/)+[0-9a-z\.\_!;,\+\-\%]+-(\d+)',
                array(
                'module' => 'frontend',
                'controller' => 'index',
                'action'     => 'viewblog'
            ),
            array(
                'mod' => 1,
                'id' =>2,
                'des' =>3
            ),
            'blog/index'
        );
        $router->addRoute('entry', $route);
                
    }
    
        
}