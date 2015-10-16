<?php

namespace Navigator\Navigation;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Navigation\Service\DefaultNavigationFactory;

class DbNavigation extends DefaultNavigationFactory
{
    protected function getPages(ServiceLocatorInterface $serviceLocator)
    {
        $navigation = array();

        if (null === $this->pages) {
            $om = $serviceLocator->get('Doctrine\ORM\EntityManager');
            $repo = $om->getRepository('Tecdoc\Entity\Manufacturers');
            $manuf = $repo->findBy(array(), array('mfaBrand' => 'ASC'));

            if ($manuf) {
                foreach ($manuf as $key => $val) {
                    /* @var $val \Tecdoc\Entity\Manufacturers */
                    $navigation[] = array(
                        'label'   => ucfirst(mb_strtolower($val->getMfaBrand())),
                        'route'   => 'models',
                        'params' => [
                            'mfaId'   => $val->getMfaId(),
                        ],
                        'imageId' => $val->getMfaId(),
                    );
                }
            }

            $mvcEvent = $serviceLocator->get('Application')
                ->getMvcEvent();

            $routeMatch = $mvcEvent->getRouteMatch();
            $router     = $mvcEvent->getRouter();
            $pages      = $this->getPagesFromConfig($navigation);

            $this->pages = $this->injectComponents(
                $pages,
                $routeMatch,
                $router
            );
        }

        return $this->pages;
    }
}