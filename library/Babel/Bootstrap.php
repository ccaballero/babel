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
        $this->bootstrap(array('config', 'frontController'));

        $view = new Zend_View();
        $config = Zend_Registry::get('config');

        // Use the php suffix in views
        $renderer = new Zend_Controller_Action_Helper_ViewRenderer();
        $renderer->setView($view)
                 ->setViewSuffix('php');

        $view->setScriptPath(
            $config->resources->layout->layoutPath .
            $config->resources->layout->layout . '/'
        );
        $view->setHelperPath(
            APPLICATION_PATH . '/library/Yachay/View/Helper',
            'Yachay_View_Helper'
        );

        Zend_Controller_Action_HelperBroker::addHelper($renderer);

        $baseUrl = $config->resources->frontController->baseUrl;

        $view->media_url = $baseUrl . '/media';

        $view->doctype($config->resources->view->doctype);
        $view->headTitle($config->babel->properties->title);

        $equivs = $config->template->httpEquiv;
        foreach ($equivs as $key => $content) {
            $view->headMeta()->appendHttpEquiv($key, $content);
        }
        $metas = $config->template->meta;
        foreach ($metas as $key => $content) {
            $view->headMeta()->appendName($key, $content);
        }

        $view->headLink(array(
            'rel' => 'icon',
            'type' => 'image/x-icon',
            'href' => $view->baseUrl($view->media_url . '/favicon.ico')));

        $css_styles = $config->template->css;
        foreach ($css_styles as $css_style) {
             $view->headLink()->appendStylesheet($view->media_url . $css_style);
        }

        $view->headScript()->appendScript('var baseUrl=\'' . $view->baseUrl() . '\'');
        $js_scripts = $config->template->js;
        foreach ($js_scripts as $js_script) {
            $view->headScript()->appendFile($view->media_url . $js_script, 'text/javascript');
        }

        $auth = Zend_Auth::getInstance();
        $view->auth = $auth;

        return $view;
    }
}
