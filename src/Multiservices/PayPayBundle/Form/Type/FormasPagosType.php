<?php

namespace Multiservices\PayPayBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManager;


class FormasPagosType extends AbstractType
{
    private $entityManager;
    private $transformer;
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'attr'=>array('class'=>'select2',
                'data-placeholder'=>'Seleccione forma de pago...'),
            'class'=>  'PayPayBundle:FormasPagos',
            'placeholder'=>'',
            'multiple'=>false
        ));
    }

    public function getParent()
    {
        return 'entity';
    }
    public function getName()
    {
        return 'formasPagos';
    }
}