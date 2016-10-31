<?php

namespace Multiservices\PayPayBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Multiservices\PayPayBundle\Form\FacturaitemsType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class FacturasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idcliente',null,array('label'=>'Cliente'))
            ->add('legal')
            //->add('emitido')
            //->add('vencimiento')
            //->add('pago')
            
            //->add('forma')
            //->add('estado')
            ///->add('tipo')
            //->add('cobrado')
            //->add('statevencido')
            //->add('credito')
            
            ->add('sub_total',HiddenType::class,array('label'=>'Sub Total',
                                             'attr'=>array('ng-value'=>'facturaSubTotal()')))
            ->add('iva_igv',HiddenType::class,array('label'=>'Iva',
                                             'attr'=>array( 'ng-value'=>'calculateTax()')))
            ->add('total',HiddenType::class,array('label'=>'Iva',
                                             'attr'=>array( 'ng-value'=>'calculateGrandTotal()')))
            
            ->add('items',CollectionType::class,array(
                'label'=>'Detalle de Factura',
                'allow_add'=>true,
                'allow_delete'=>true,
                'by_reference'=>false,
                'entry_type'   => FacturaitemsType::class,
                
            ))    
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Multiservices\PayPayBundle\Entity\Facturas',
            //'attr' => array('ng-submit'=>"processForm(\$event,'facturas')")
        ));
    }
}
