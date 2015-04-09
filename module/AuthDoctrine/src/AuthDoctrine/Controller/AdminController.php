<?php
namespace AuthDoctrine\Controller;

use AuthDoctrine\Entity\User;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use AuthDoctrine\Form\LoginForm;
use AuthDoctrine\Form\LoginFilter;

use AuthDoctrine\Acl\Acl;

class AdminController extends AbstractActionController
{
    public function indexAction()
    {
        return $this->redirect()->toRoute('admin-login');
    }

    public function loginAction()
    {
        if ($user = $this->identity()) {
            return $this->redirect()->toRoute('admin');
        }

        $form = new LoginForm();
        $messages = null;

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter(new LoginFilter($this->getServiceLocator()));
            $form->setData($request->getPost());

            if ($form->isValid()) {

                $data = $form->getData();

                $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
                $adapter = $authService->getAdapter();
                $adapter->setIdentityValue($data['email']);
                $adapter->setCredentialValue($data['password']);
                $authResult = $authService->authenticate();

                if ($authResult->isValid()) {
                    $identity = $authResult->getIdentity();
                    $authService->getStorage()->write($identity);
                    $time = 1209600; // 14 days 1209600/3600 = 336 hours => 336/24 = 14 days
                    if ($data['rememberMe']) {
                        $sessionManager = new \Zend\Session\SessionManager();
                        $sessionManager->rememberMe($time);
                    }
                    return $this->redirect()->toRoute('admin');
                }
                foreach ($authResult->getMessages() as $message) {
                    $messages .= "$message\n";
                }
            }
        }

        $view = new ViewModel(array(
            'error' => 'Авторизация не проканала.',
            'form'	=> $form,
            'messages' => $messages,
        ));
        $view->setTerminal(true);

        return $view;
	}
}