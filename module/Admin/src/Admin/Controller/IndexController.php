<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
//        $this->redirect()->toRoute('admin-login');
//        $this->layout('admin/layout/layout');
        return new ViewModel();
    }
}