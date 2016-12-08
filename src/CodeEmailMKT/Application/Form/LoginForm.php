<?php
namespace CodeEmailMKT\Application\Form;

use CodeEmailMKT\Application\InputFilter\CustomerInputFilter;
use CodeEmailMKT\Domain\Entity\CustomerEntity;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Hydrator\ClassMethods;

class LoginForm extends Form
{
    public function __construct($name = 'login', array $options = [])
    {
        parent::__construct($name, $options);

        // Elementos
        $this->add([
            'name' => 'email',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'E-mail'
            ],
            'attributes' => [
                'id' => 'email',
                'type' => 'email'
            ]
        ]);

        $this->add([
            'name' => 'passwordPlain',
            'type' => Element\Password::class,
            'options' => [
                'label' => 'Senha'
            ],
            'attributes' => [
                'id' => 'passwordPlain'
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => Element\Button::class,
            'options' => [
                'label' => 'Entrar'
            ],
            'attributes' => [
                'id' => 'submit',
                'type' => 'submit'
            ]
        ]);
    }
}