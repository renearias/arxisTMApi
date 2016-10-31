<?php

namespace Multiservices\PayPayBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class FacturaitemsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          //  ->add('userid')
          //  ->add('descripcion')
          //->add('idfactura')
          ->add('idproducto',null,array('label'=>'Producto',
                                        //'attr'=>array('ng-model'=>'item.producto',)
                                            
                                        ))
          ->add('cantidad',null,array('label'=>'Cantidad',
                                      //'attr'=>array('ng-model'=>'item.qty')
                                        ))
          ->add('punitario',null,array('label'=>'Unitario',
                                       //'attr'=>array('ng-model'=>'item.cost')
                                           ))
          ->add('descuento',null,array('label'=>'% Descuento',
                                      //'attr'=>array('ng-model'=>'item.discount')
                                            ))      
          //  ->add('tipo')
          //  ->add('idalmacen')
            //->add('unidades')
          
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Multiservices\PayPayBundle\Entity\Facturaitems',
            'attr' => array('ng-submit'=>"processForm(\$event,'".$this->getName()."')")
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'multiservices_paypaybundle_facturaitems';
    }
}
