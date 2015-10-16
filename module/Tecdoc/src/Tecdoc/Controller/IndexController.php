<?php

namespace Tecdoc\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return $this->redirect()->toRoute('catalog');
    }

    public function catalogAction()
    {
        $om = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $manuf = $om->getRepository('Tecdoc\Entity\Manufacturers')->findBy(array(), array('mfaBrand' => 'ASC'));

        return new ViewModel(['manuf' => $manuf]);
    }

    public function modelsAction()
    {
        $mfaId = $this->params()->fromRoute('mfaId', null);

        if ($mfaId === null)
            return $this->redirect()->toRoute('catalog');

        $om = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $models = $om->getRepository('Tecdoc\Entity\Models')->findBy(['mfaId' => $mfaId], ['modName' => 'ASC']);

        return new ViewModel(['models' => $models]);
    }

    public function carsAction()
    {
        $modId = $this->params()->fromRoute('modId', null);
        $fuelId = $this->params()->fromRoute('fuelId', null);

        if ($modId === null)
            return $this->redirect()->toRoute('catalog');

        $om = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $arrWhere = ['modId' => $modId];
        if ($fuelId != null)
            $arrWhere['fuelId'] = $fuelId;

        $cars = $om->getRepository('Tecdoc\Entity\Types')->findBy($arrWhere, ['cds' => 'ASC']);
        if ($cars) {
            $model = $om->getRepository('Tecdoc\Entity\Models')->findOneBy(['modId' => $cars[0]->getModId()]);
            $arrFuel = $om->getRepository('Tecdoc\Entity\TypesFuel')->findBy(['modId' => $modId], ['desText' => 'ASC']);
        } else {
            return $this->redirect()->toRoute('catalog');
        }

        return new ViewModel([
            'mfaId' => $model->getMfaId(),
            'modId' => $modId,
            'cars' => $cars,
            'arrFuel' => $arrFuel,
        ]);
    }

    public function fullInfoAction()
    {
        $typId = $this->params()->fromRoute('typId', null);

        if ($typId === null)
            return $this->redirect()->toRoute('catalog');

        $om = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $fullInfo = $om->getRepository('Tecdoc\Entity\TypesFullInfo')->findOneBy(['typId' => $typId]);
        if ($fullInfo) {
//            /* @var $fullInfo \Tecdoc\Entity\TypesFullInfo */
//            $model = $om->getRepository('Tecdoc\Entity\Models')->findOneBy(['modId' => $fullInfo->getModId()]);
//            /* @var $model \Tecdoc\Entity\Models */
            $engines = $om->getRepository('Tecdoc\Entity\Engines')->findBy(['typId' => $typId]);
        }

        return new ViewModel([
            'fullInfo' => $fullInfo,
            'engines' => $engines,
        ]);
    }
}