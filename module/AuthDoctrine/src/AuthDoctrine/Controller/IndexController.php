<?php
namespace AuthDoctrine\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
		return $this->redirect()->toRoute('logout');
    }
	
	public function logoutAction()
	{
		$auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
		$auth->clearIdentity();

		$sessionManager = new \Zend\Session\SessionManager();
		$sessionManager->forgetMe();
        setcookie('lockScreen', '', -3600, '/', $this->getRequest()->getUri()->getHost());
		
		return $this->redirect()->toRoute('home');
	}
}