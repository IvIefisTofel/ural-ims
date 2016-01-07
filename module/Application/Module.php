<?php
namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use AuthDoctrine\Acl\Acl;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

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
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $repository = $e->getApplication()->getServiceManager()->get('Doctrine\ORM\EntityManager')->getRepository('Settings\Entity\Settings');
        $lockscreenEnabled = $repository->findOneByName('lockscreen_enabled');
        if ($lockscreenEnabled != null && $lockscreenEnabled->getValue()) {
            $lockscreenTimeout = $repository->findOneByName('lockscreen_timeout');
            if ($lockscreenTimeout != null) {
                /* @var $baseModel ViewModel */
                $baseModel = $e->getViewModel();
                $baseModel->setVariable('lockscreen_timeout', $lockscreenTimeout->getValue() * 1000);
            }
        }

        $eventManager->attach('route', array($this, 'onRoute'), -100);


        $eventManager->getSharedManager()->attach('Zend\Mvc\Controller\AbstractController', 'dispatch', function($e) {
            $controller      = $e->getTarget();
            $controllerClass = get_class($controller);
            $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
            $config          = $e->getApplication()->getServiceManager()->get('config');
            if (isset($config['module_layouts'][$moduleNamespace])) {
                $controller->layout($config['module_layouts'][$moduleNamespace]);
            }
        }, 100);
    }

    public function onRoute(\Zend\EventManager\EventInterface $e)
    {
        $application = $e->getApplication();
        $routeMatch = $e->getRouteMatch();
        $serviceManager = $application->getServiceManager();
        $auth = $serviceManager->get('Zend\Authentication\AuthenticationService');
        $config = $serviceManager->get('Config');
        $acl = new Acl($config);

        $role = Acl::DEFAULT_ROLE;
        if ($auth->hasIdentity())
            $role = $auth->getIdentity()->getUserRoleId();

        $controller = $routeMatch->getParam('controller');
        $action = $routeMatch->getParam('action');

        if (!$acl->hasResource($controller)) {
            throw new \Exception('Ресурс ' . $controller . ' не определен в acl.config.');
        }

        if (!$acl->isAllowed($role, $controller, $action)) {

            /**
             * Показать ошибку 404
            */
            $eventManager = $application->getEventManager();
            $eventManager->attach(MvcEvent::EVENT_DISPATCH, function($e) {
                $routeMatch = $e->getRouteMatch();

                $routeMatch->setParam('controller', 'AuthDoctrine\Controller\Index');
                $routeMatch->setParam('action', 'accessdenied');

                if ($e->getRouteMatch()->getParam('__NAMESPACE__') == 'Admin\Controller' &&
                    $e->getApplication()->getServiceManager()->get('doctrine.authenticationservice.orm_default')->getIdentity()) {
                    $request = $e->getApplication()->getServiceManager()->get('request');
                    if ($request->isXmlHttpRequest() && $request->isPost()) {
                        $baseModel =  new JsonModel(array(
                            'error' => true,
                            'msgHeader' => 'Ошибка',
                            'message' => 'Не достаточно прав.',
                        ));
                        $e->setViewModel($baseModel);
                    } else {
                        $e->getViewModel()->setTemplate('layout/admin');
                        $e->setError('ACL_ACCESS_DENIED')->setParam('route', $routeMatch->getMatchedRouteName());
                        $e->getTarget()->getEventManager()->trigger('dispatch.error', $e);

                        $result = $e->getResult();

                        if ($result instanceof StdResponse) {
                            return;
                        }

                        $baseModel = $e->getViewModel();
                        $baseModel->setTemplate('layout/admin');

                        $model = new ViewModel();
                        $model->setTemplate('error/accessdenied');

                        $baseModel->addChild($model);
                        $baseModel->setTerminal(true);
                    }
                }
            }, 1000);

            /**
             * Редирект на главную
             */
//            $url = $e->getRouter()->assemble(array(), array('name' => 'home'));
//            $response = $e->getResponse();
//
//            $response->getHeaders()->addHeaderLine('Location', $url);
//
//            $response->setStatusCode(302);
//            $response->sendHeaders();
//            exit;
        }
    }
}