<?php

namespace Multiservices\TaskBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TareaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tarea')
                ->add('descripcion')
                //->add('created')
                //->add('finished')
                ->add('isurgent')
                ->add('isread')
                ->add('timeEstimate')
                ->add('priority')
                //->add('state')
                //->add('parent')
                //->add('createdby')
                ->add('assignedto')
                //->add('finishby')
                /*->add('tasktemplate')*/        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Multiservices\TaskBundle\Entity\Tarea'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'multiservices_taskbundle_tarea';
    }


}
