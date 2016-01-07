<?php
namespace Ims;

use Zend\Mvc\MvcEvent;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
	
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                'numEnding' => 'Lit\View\Helper\NumEnding',
                'setCurrentNavigationPage' => 'Lit\View\Helper\SetCurrentNavigationPage',
                'addCurrentBreadCrumb' => 'Lit\View\Helper\AddCurrentBreadCrumb',
            ),
        );
    }

    public function onBootstrap(MvcEvent $e)
    {
        require_once ('Libs/CSSMin.php');
        require_once ('Libs/JSMin.php');
    }
}	