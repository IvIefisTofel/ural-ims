<?php
namespace Files\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Assetic\Asset\FileAsset;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $repository = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->getRepository('Fields\Entity\FieldsValues');
        /* @var $field \Fields\Entity\FieldsValues */
        $field = $repository->findOneByAlias($this->params()->fromRoute('alias'));

        if ($field != null) {
            $file = new FileAsset($field->getValue());
            $file->load();

            header('Content-Type: ' . mime_content_type($field->getValue()));
            echo $file->dump();
            exit;
        } else {
            $this->getResponse()->setStatusCode(404);
            return;
        }
    }
}