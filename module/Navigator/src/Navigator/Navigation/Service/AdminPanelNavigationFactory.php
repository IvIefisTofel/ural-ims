<?php

namespace Navigator\Navigation\Service;

use Zend\Navigation\Service\DefaultNavigationFactory;

class AdminPanelNavigationFactory extends DefaultNavigationFactory
{
    protected function getName()
    {
        return 'admin-panel';
    }
}