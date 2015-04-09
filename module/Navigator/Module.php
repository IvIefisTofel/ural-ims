<?php

namespace Navigator;

use Zend\View\HelperPluginManager;

class Module
{
	protected $sm;
	
    public function getConfig()
    {
        return array();
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
	
	public function onBootstrap(\Zend\EventManager\EventInterface $e) // use it to attach event listeners
	{
		$application = $e->getApplication();
		$this->sm = $application->getServiceManager();
		// var_dump($this->sm);
	}
	
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'navigation' => function(HelperPluginManager $pm) {
					$sm = $pm->getServiceLocator();
					$config = $sm->get('Config');

					$acl = new \AuthDoctrine\Acl\Acl($config);

					// Get the AuthenticationService
					$auth = $sm->get('Zend\Authentication\AuthenticationService');

					$role = \AuthDoctrine\Acl\Acl::DEFAULT_ROLE; // The default role is guest $acl
					if ($auth->hasIdentity())
                        $role = $auth->getIdentity()->getUsrRoleId();

                    $navigation = $pm->get('Zend\View\Helper\Navigation');
                    $navigation->setAcl($acl)->setRole((string)$role);

                    return $navigation;
                }
            )
        );
    }
	
}