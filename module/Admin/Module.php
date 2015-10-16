<?php
namespace Admin;

use Zend\Mvc\MvcEvent;

class Module
{
    private $requestUri;

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

    public function onBootstrap(MvcEvent $e)
    {
        $application = $e->getApplication();
        $em = $application->getEventManager();
        //handle the dispatch error (exception)
        $em->attach('dispatch', array($this, 'handleError'));

        if (isset($_COOKIE['lockScreen'])) {
            if ($_COOKIE['lockScreen']) {
                $sm = $application->getServiceManager();
                $router = $sm->get('router');

                /* @var $request \Zend\Http\PhpEnvironment\Request */
                $request = $sm->get('request');
                $this->requestUri = $request->getRequestUri();

                $matchedRoute = $router->match($request);

                /* @var $matchedRoute \Zend\Mvc\Router\Http\RouteMatch */
                if ($matchedRoute->getMatchedRouteName() != 'lock-screen' && $matchedRoute->getParam('__NAMESPACE__') == 'Admin\Controller') {
                    $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) {
                        $controller = $e->getTarget();
                        $controller->plugin('redirect')->toUrl('/lockscreen?uri=' . $this->requestUri);
                    }, 100);
                }
            }
        }
    }

    public function handleError(MvcEvent $e)
    {
        if ($e->isError()) {
            var_dump($e->getError());
            exit;
        }

        /*
        $application   = $e->getApplication();
        $sm            = $application->getServiceManager();
        $router = $sm->get('router');
        $request = $sm->get('request');
        $matchedRoute = $router->match($request);
        $url = $sm->get('viewhelpermanager')->get('url');
        var_dump($url('admin', [], ['force_canonical' => true]));
        exit;
        */
    }
}
