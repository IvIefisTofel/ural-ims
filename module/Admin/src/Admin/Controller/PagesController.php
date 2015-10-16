<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PagesController extends AbstractActionController
{
    public function indexAction()
    {
        $om = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $pages = $om->getRepository('Pages\Entity\Pages')->findAll();

        return new ViewModel([
            'pages' => $pages,
        ]);
    }

    public function pagePreviewAction()
    {
        $id = $this->params()->fromRoute('id', 0);

        $om = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        /* @var $page \Pages\Entity\Pages */
        $page = $om->getRepository('Pages\Entity\Pages')->find($id);

        if ($page == null || !$page->getActive() || new \DateTime() < $page->getDate()) {
            $view = new ViewModel();
            $view->setTemplate('layout/layout');
            $this->getResponse()->setStatusCode(404);

            return $view;
        }

        $fields = $om->getRepository('Fields\Entity\Fields')->findBy(['alias' => ['seo_title', 'seo_keywords', 'seo_description']]);
        $fieldIDs = [];
        /* @var $field \Fields\Entity\Fields */
        foreach ($fields as $field) {
            $fieldIDs[$field->getFieldID()] = $field->getAlias();
        }

        /*$fieldValues = $om->getRepository('Fields\Entity\FieldsValues')->findBy(['fieldID' => array_keys($fieldIDs), 'alias' => $page->getAlias()]);
        $seo = [];
        foreach ($fieldValues as $value){
            $seo[$fieldIDs[$value->getFieldID()]] = $value->getValue();
        }*/

        $form = $om->getRepository('Fields\Entity\FieldsValues')->findOneBy([
            'fieldID' => $om->getRepository('Fields\Entity\Fields')->findOneBy(['alias' => 'form'])->getFieldID(),
            'alias' => $page->getFormName(),
        ]);

        $view = new ViewModel([
            'page' => $page,
            'form' => $form->getValue(),
        ]);
        $this->layout('layout/layout');

        return $view;
    }

    public function editPageAction()
    {
        $id = $this->params()->fromRoute('id', 0);

        $om = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $page = $om->getRepository('Pages\Entity\Pages')->findOneByPageId($id);
        /* @var $page \Pages\Entity\Pages */

        if (!$page) {
            return $this->redirect()->toRoute('admin/default', ['controller' => 'pages', 'action' => 'index']);
        }

        $formsList = $this->forward()->dispatch('Lit\Controller\Helper', array('action' => 'getFormsList'))->getVariables();
        $seo = $this->forward()->dispatch('Lit\Controller\Helper', array('action' => 'getSeo', 'alias' => $page->getAlias()))->getVariables();

        $request = $this->getRequest();
        if($request->isPost()) {
            $data = $request->getPost();

            // write SEO info
            $this->forward()->dispatch('Lit\Controller\Helper', array('action' => 'setSeo',
                'alias'           => $page->getAlias(),
                'seo_title'       => $data['seo_title'],
                'seo_keywords'    => $data['seo_keywords'],
                'seo_description' => $data['seo_description'],
            ));

            $page->setAlias($data['alias']);
            $page->setName($data['name']);
            $page->setContent($data['content']);
            $page->setFormName($data['form']);
            $page->setActive($data['active']);
            $page->setDate(new \DateTime($data['date']));

            $om->persist($page);
            $om->flush();

            return $this->redirect()->toRoute('admin/default', array('controller' => 'pages', 'action' => 'index'));
        }

        return new ViewModel(array_merge(
            [
                'page' => $page,
            ],
            $formsList,
            $seo
        ));
    }
}