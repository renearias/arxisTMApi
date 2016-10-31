<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManager;
//use Multiservices\UbicatexBundle\Form\DataTransformer\CiudadToNumberTransformer;

class UsersType extends AbstractType
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
                'data-placeholder'=>'Seleccione usuarios...'),
            'class'=>  'MultiservicesArxisBundle:Usuario',
            'placeholder'=>'',
            'multiple'=>true
        ));
    }

    public function getParent()
    {
        return 'entity';
    }
    public function getName()
    {
        return 'users';
    }
}