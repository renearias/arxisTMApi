<?php
/*
* Todos los Derechos Reservados Arxis
 */

/**
 * Description of RegistrationType
 *
 * @author Rene Arias <renearias@arxis.la>
 */
namespace Multiservices\NotifyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Multiservices\ArxisBundle\Form\Type\UsersType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class NotificacionesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('actionid')    
            ->add('notificacion', TextareaType::class)
            ->add('notificacionuser',  UsersType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Multiservices\NotifyBundle\Entity\Notificaciones',
            'attr' => array('ng-submit'=>"processForm(\$event,'".$this->getName()."')")
        ));
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return 'notificaciones';
    }
}
