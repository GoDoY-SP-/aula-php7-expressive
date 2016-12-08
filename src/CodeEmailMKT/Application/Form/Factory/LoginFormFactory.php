<?php
namespace CodeEmailMKT\Application\Form\Factory;

use CodeEmailMKT\Application\Form\LoginForm;
use CodeEmailMKT\Application\InputFilter\LoginInputFilter;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;

class LoginFormFactory
{
    public function __invoke(ContainerInterface $container)
    {
        // Form
        $form = new LoginForm();

        // Hydrator
//        $form->setHydrator(new ClassMethods());
//        $form->setObject(new CustomerEntity());

        // InputFilter
        $form->setInputFilter(new LoginInputFilter());

        return $form;
    }
}