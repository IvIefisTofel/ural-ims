<?php
namespace AuthDoctrine\Form;

use Zend\Form\Form;

class UserForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('registration');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'usr_name',
            'attributes' => array(
                'type'  => 'text',
                'id' => 'usr_name',
            ),
            'options' => array(
                'label' => 'Имя пользователя',
                'column-size' => 'sm-4',
                'label_attributes' => array('class' => 'col-sm-2')
            ),
        ));

        $this->add(array(
            'name' => 'usr_password',
            'attributes' => array(
                'type'  => 'password',
                'id' => 'usr_password',
            ),
            'options' => array(
                'label' => 'Пароль',
                'column-size' => 'sm-4',
                'label_attributes' => array('class' => 'col-sm-2')
            ),
        ));

        $this->add(array(
            'name' => 'usr_email',
            'attributes' => array(
                'type'  => 'email',
                'id' => 'usr_email',
            ),
            'options' => array(
                'label' => 'e-mail',
                'column-size' => 'sm-4',
                'label_attributes' => array('class' => 'col-sm-2')
            ),
        ));

        $this->add(array(
            'name' => 'usr_Role',
			'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Права доступа',
				'value_options' => array(
                    \AuthDoctrine\Entity\User::ROLE_ADMIN => 'Admin',
                    \AuthDoctrine\Entity\User::ROLE_MODER => 'Moderator',
                    \AuthDoctrine\Entity\User::ROLE_USER  => 'User',
				),
                'column-size' => 'sm-4',
                'label_attributes' => array('class' => 'col-sm-2')
            ),
            'attributes' => array(
                'id' => 'usr_Role',
            ),
        ));

        $this->add(array(
            'name' => 'usr_active',
			'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Активный',
				'value_options' => array(
                    '1' => 'Да',
					'0' => 'Нет',
				),
                'column-size' => 'sm-4',
                'label_attributes' => array('class' => 'col-sm-2')
            ),
            'attributes' => array(
                'id' => 'usr_active',
            ),
        ));

        $this->add(array(
            'name' => 'usr_picture',
            'attributes' => array(
                'type'  => 'text',
                'id' => 'usr_picture',
            ),
            'options' => array(
                'label' => 'URL изображения',
                'column-size' => 'sm-4',
                'label_attributes' => array('class' => 'col-sm-2')
            ),
        ));

        $this->add(array(
            'name' => 'usr_registration_date',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\DateTime',
                'id' => 'usr_registration_date',
            ),
            'options' => array(
                'label' => 'Дата регистрации',
                'column-size' => 'sm-4',
                'label_attributes' => array('class' => 'col-sm-2')
            ),
        ));

        $this->add(array(
            'name' => 'usr_email_confirmed',
			'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'E-mail подтвержден?',
				'value_options' => array(
					'0' => 'Нет',
					'1' => 'Да',
				),
                'column-size' => 'sm-4',
                'label_attributes' => array('class' => 'col-sm-2')
            ),
            'attributes' => array(
                'id' => 'usr_email_confirmed',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'button',
            'attributes' => array(
                'type' => 'submit',
                'id' => 'submitbutton',
            ),
            'options' => array(
                'label' => 'Отправить',
                'column-size' => 'sm-10 col-sm-offset-2'
            ),
        ));
    }
}