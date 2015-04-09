<?php
namespace AuthDoctrine\Form;

use Zend\Form\Form;

class LoginForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('login');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type' => 'email',
                'placeholder' => 'Email',
            ),
        ));
        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type' => 'password',
                'placeholder' => 'Пароль',
            ),
        ));

        $this->add(array(
            'name' => 'rememberMe',
            'type' => 'checkbox',
            'options' => array('label' => 'Запомнить меня'),
            'required' => false,
        ));	

        $this->add(array(
            'name' => 'submit',
            'type' => 'button',
            'attributes' => array(
                'type' => 'submit',
                'class' => 'btn btn-lg btn-primary btn-block'
            ),
            'options' => array(
                'label' => 'Вход'
            ),
        )); 
    }
}