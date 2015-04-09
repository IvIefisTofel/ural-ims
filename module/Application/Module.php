<?php
namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use AuthDoctrine\Acl\Acl;
use Zend\View\Model\ViewModel;

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

        $translator = new \Zend\I18n\Translator\Translator();
        $translator->addTranslationFile(
            'phpArray',
            'vendor/zendframework/zendframework/resources/languages/ru/Zend_Validate.php',
            'default',
            'ru_RU'
        );
        \Zend\Validator\AbstractValidator::setDefaultTranslator(new \Zend\Mvc\I18n\Translator($translator));
    }

    public function onRoute(\Zend\EventManager\EventInterface $e) // Event manager of the app
    {
        $application = $e->getApplication();
        $routeMatch = $e->getRouteMatch();
        $serviceManager = $application->getServiceManager();
        $auth = $serviceManager->get('Zend\Authentication\AuthenticationService');
        $config = $serviceManager->get('Config');
        $acl = new Acl($config);

        $role = Acl::DEFAULT_ROLE;
        if ($auth->hasIdentity())
            $role = $auth->getIdentity()->getUsrRoleId();

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