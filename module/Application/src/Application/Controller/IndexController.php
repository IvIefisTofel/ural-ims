<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function machiningAction()
    {
        return new ViewModel();
    }

    public function plasticAction()
    {
        return new ViewModel();
    }

    public function contactsAction()
    {
        return new ViewModel();
    }
}