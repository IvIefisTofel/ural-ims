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
                'getSiteParam' => View\Helper\GetSiteParam::class,
                'numEnding' => View\Helper\NumEnding::class,
                'setCurrentNavigationPage' => View\Helper\SetCurrentNavigationPage::class,
                'addCurrentBreadCrumb' => View\Helper\AddCurrentBreadCrumb::class,
            ),
        );
    }

    public function onBootstrap(MvcEvent $e)
    {
        require_once ('Libs/CSSMin.php');
        require_once ('Libs/JSMin.php');
    }
}	