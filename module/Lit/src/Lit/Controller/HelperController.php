<?php
namespace Lit\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class HelperController extends AbstractActionController
{
    public function indexAction()
    {
        $this->getResponse()->setStatusCode(404);
        return;
    }

    /**
     * @return ViewModel
     * Не имее своего View. Функция для вызова через Forward
     * Возвращяет массив форм в виде [alias => formName]
     */
    public function getFormsListAction()
    {
        $om = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $fields = $om->getRepository('Fields\Entity\Fields')->findBy(['alias' => 'form_name']);
        $fieldIDs = [];
        foreach ($fields as $field) {
            /* @var $field \Fields\Entity\Fields */
            $fieldIDs[$field->getFieldID()] = $field->getAlias();
        }

        $forms = [];
        if (count($fieldIDs) > 0) {
            $arrForms = $om->getRepository('Fields\Entity\FieldsValues')->findBy(['fieldID' => array_keys($fieldIDs)]);
            foreach ($arrForms as $fieldValue) {
                /* @var $fieldValue \Fields\Entity\FieldsValues */
                $forms[$fieldValue->getAlias()] = $fieldValue->getValue();
            }
        }

        return new ViewModel([
            'forms' => $forms,
        ]);
    }

    /**
     * @return ViewModel
     * Не имее своего View. Функция для вызова через Forward
     * Возвращяет массив seo в виде [seo_* => seo_value]
     */
    public function getSeoAction()
    {
        $alias = $this->params('alias', null);

        $om = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $fields = $om->getRepository('Fields\Entity\Fields')->findBy(['alias' => ['seo_title', 'seo_keywords', 'seo_description']]);
        $fieldIDs = [];
        foreach ($fields as $field) {
            /* @var $field \Fields\Entity\Fields */
            $fieldIDs[$field->getFieldID()] = $field->getAlias();
        }

        $seo = [];
        if (count($fieldIDs) > 0) {
            if ($alias) {
                $arrSeo = $om->getRepository('Fields\Entity\FieldsValues')->findBy(['fieldID' => array_keys($fieldIDs), 'alias' => $alias]);
                foreach ($arrSeo as $fieldValue) {
                    /* @var $fieldValue \Fields\Entity\FieldsValues */
                    $seo[$fieldIDs[$fieldValue->getFieldID()]] = $fieldValue->getValue();
                }
            } else {
                foreach ($fieldIDs as $fieldValue) {
                    $seo[$fieldValue] = null;
                }
            }
        }

        return new ViewModel([
            'seo' => $seo,
        ]);
    }

    /**
     * @return ViewModel
     * Не имее своего View. Функция для вызова через Forward
     * Возвращяет $result типа boolean
     */
    public function setSeoAction()
    {
        $alias      = $this->params('alias', null);
        $params = [
            'seo_title'       => $this->params('seo_title', null),
            'seo_keywords'    => $this->params('seo_keywords', null),
            'seo_description' => $this->params('seo_description', null)
        ];
        $result = false;

        if ($alias) {
            $om = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $fields = $om->getRepository('Fields\Entity\Fields')->findBy(['alias' => ['seo_title', 'seo_keywords', 'seo_description']]);
            $fieldIDs = [];
            foreach ($fields as $field) {
                /* @var $field \Fields\Entity\Fields */
                $fieldIDs[$field->getFieldID()] = $field->getAlias();
            }

            if (count($fieldIDs) > 0) {
                $arrSeo = $om->getRepository('Fields\Entity\FieldsValues')->findBy(['fieldID' => array_keys($fieldIDs), 'alias' => $alias]);
                if ($arrSeo) {
                    foreach ($arrSeo as $fieldValue) {
                        /* @var $fieldValue \Fields\Entity\FieldsValues */
                        $fieldValue->setValue($params[$fieldIDs[$fieldValue->getFieldID()]]);
                        $om->persist($fieldValue);
                    }
                    $om->flush();
                    $result = true;
                }
            }
        }


        return new ViewModel([
            'result' => $result,
        ]);
    }
}