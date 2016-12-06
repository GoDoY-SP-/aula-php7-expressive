<?php
namespace CodeEmailMKT\Application\Form;

use CodeEmailMKT\Application\InputFilter\CustomerInputFilter;
use CodeEmailMKT\Domain\Entity\CustomerEntity;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Hydrator\ClassMethods;

class CustomerForm extends Form
{
    public function __construct($name = 'customer', array $options = [])
    {
        parent::__construct($name, $options);
        // Hydrator
        $this->setHydrator(new ClassMethods());
        $this->setObject(new CustomerEntity());

        // InputFilter
        $this->setInputFilter(new CustomerInputFilter());

        // Elementos
        $this->add([
            'name' => 'id',
            'type' => Element\Hidden::class,
            'attributes' => [
                'id' => 'id'
            ]
        ]);

        $this->add([
            'name' => 'name',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Nome'
            ],
            'attributes' => [
                'id' => 'name'
            ]
        ]);

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
            'name' => 'submit',
            'type' => Element\Button::class,
            'options' => [
                'label' => 'Enviar'
            ],
            'attributes' => [
                'id' => 'submit',
                'type' => 'submit'
            ]
        ]);
    }
}