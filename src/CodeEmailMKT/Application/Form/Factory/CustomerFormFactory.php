<?php
namespace CodeEmailMKT\Application\Form\Factory;

use CodeEmailMKT\Application\Form\CustomerForm;
use CodeEmailMKT\Application\InputFilter\CustomerInputFilter;
use CodeEmailMKT\Domain\Entity\CustomerEntity;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;

class CustomerFormFactory
{
    public function __invoke(ContainerInterface $container)
    {
        // Form
        $form = new CustomerForm();

        // Hydrator
        $form->setHydrator(new ClassMethods());
        $form->setObject(new CustomerEntity());

        // InputFilter
        $form->setInputFilter(new CustomerInputFilter());

        return $form;
    }
}