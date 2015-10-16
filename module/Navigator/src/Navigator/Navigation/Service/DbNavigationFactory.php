<?php

namespace Navigator\Navigation\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Navigator\Navigation\DbNavigation;

class DbNavigationFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $navigation = new DbNavigation();
        return $navigation->createService($serviceLocator);
    }
}