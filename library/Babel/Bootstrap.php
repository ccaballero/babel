<?php

class Babel_Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initConfig() {
        $config = new Zend_Config($this->getOptions());
        Zend_Registry::set('config', $config);
        return $config;
    }

    protected function _initAutoload() {
        $loader = Zend_Loader_Autoloader::getInstance();

        $resourceTypes = array(
            'form' => array(
                'path' => 'forms/',
                'namespace' => 'Form',
            ),
        );
        $modules = array(
            'auth', 'books', 'catalogs', 'frontpage',
            'help', 'search', 'settings', 'tags', 'users');

        foreach ($modules as $module) {
            $loader->pushAutoloader(new Zend_Application_Module_Autoloader(
                array(
                    'namespace' => ucfirst($module),
                    'basePath' => APPLICATION_PATH . '/apps/' . $module,
                    'resourceTypes' => $resourceTypes
                )
            ));
        }

        $loader->pushAutoloader(new Babel_Models_Loader());
        return $loader;
    }

    protected function _initRouter() {
        $options = $this->getOptions();
        
        $ctrl = Zend_Controller_Front::getInstance();
        $router = $ctrl->getRouter();

        $router_file = $options['resources']['router'];
        $config = new Zend_Config_Ini($router_file);
        $router->addConfig($config, 'production');

        return $router;
    }

    protected function _initSession() {
        Zend_Session::start();

        $session = new Zend_Session_Namespace('babel');

        $language = 'en';
        if (isset($session->lang)) {
            $language = $session->lang;
        } else {
            if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
                $language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            }
        }

        Zend_Registry::set('lang', $language);
    }

    protected function _initTranslate() {
        $this->bootstrap(array('session'));

        $i18n = APPLICATION_PATH . '/data/i18n/';
        $language = Zend_Registry::get('lang');

        if (!file_exists($i18n . $language . '.csv')) {
            $language = 'en';
        }
        $content = $i18n . $language . '.csv';

        Zend_Registry::set('lang', $language);

        $translate = new Zend_Translate(array(
            'adapter' => 'csv',
            'content' => $content,
            'delimiter' => ','
        ));

        Zend_Registry::set('Zend_Translate', $translate);
        Zend_Form::setDefaultTranslator($translate);
        Zend_Validate_Abstract::setDefaultTranslator($translate);

        return $translate;
    }

    protected function _initView() {
        $this->bootstrap('frontController');

        // Use the php suffix in views
        $renderer = new Zend_Controller_Action_Helper_ViewRenderer();
        $renderer->setViewSuffix('php');
        Zend_Controller_Action_HelperBroker::addHelper($renderer);

        $options = $this->getOptions();

        $view = new Zend_View();

        $css_theme = $options['babel']['properties']['css'];

        $view->headTitle($options['babel']['properties']['title']);
        $view->doctype($options['resources']['view']['doctype']);
        $view->headMeta()->appendHttpEquiv(
            'Content-Type', 'text/html; charset=utf-8');
        $view->headLink(array(
            'rel' => 'icon',
            'href' => $view->baseUrl('/babel-small.png'))
        );

        $view->headScript()->appendFile($view->baseUrl('/media/js/jquery-1.6.2.min.js'), 'text/javascript')
                           ->appendFile($view->baseUrl('/media/js/jquery.tools.min.js'), 'text/javascript')
                           ->appendScript('var baseUrl=\'' . $view->baseUrl() . '\'')
                           ->appendFile($view->baseUrl('/media/js/babel.js', 'text/javascript'));

        $view->headLink()->appendStylesheet($view->baseUrl('/media/css/base.css'))
                         ->appendStylesheet($view->baseUrl('/media/' . $css_theme . '/tipography.css'))
                         ->appendStylesheet($view->baseUrl('/media/' . $css_theme . '/colors.css'))
                         ->appendStylesheet($view->baseUrl('/media/' . $css_theme . '/shadows.css'));

        // Browser semi-detection
        if (isset($_SERVER) && isset($_SERVER['HTTP_USER_AGENT'])) {
            if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'firefox')) {
                $view->headLink()->appendStylesheet($view->baseUrl('/media/' . $css_theme . '/firefox.css'));
            } else if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'chrome')) {
                $view->headLink()->appendStylesheet($view->baseUrl('/media/' . $css_theme . '/webkit.css'));
            }
        }

        return $view;
    }
}
