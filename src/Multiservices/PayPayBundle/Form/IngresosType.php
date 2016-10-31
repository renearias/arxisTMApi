<?php

namespace Multiservices\PayPayBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;
use Doctrine\ORM\PersistentCollection;
use Doctrine\ORM\EntityRepository;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Multiservices\PayPayBundle\Entity\Facturas;
use Arxis\ContableBundle\Entity\Contacto as Cliente;
use Multiservices\PayPayBundle\Entity\Ingresos;

//use ContableBundle\Form\Type\ClienteType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class IngresosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha', DateTimeType::class, ["description"=>"Fecha de Ingreso"])
            ->add('cliente') //,  ClienteType::class)
            ->add('monto',NumberType::class,['attr'=>
                                                    ['step'=>'0.01']]
                                            )
            ->add('descripcion')
            ->add('referencia')
           // ->add('collectedby')
          //  ->add('modifiedby')
            ->add('formaPago')
           // ->add('factura')
           
        ;
                
                
        /*$formModifier = function (FormInterface $form, Cliente $cliente = null, PersistentCollection $facturas=null) {
                
               $facturas = null === $facturas ? array() : $facturas->toArray();
                
                $formOptions = array(
                    'class'       => 'PayPayBundle:Facturas',
                    'placeholder' => '',
                    //'choices'     => $facturas,
                    'multiple'=>true,
                    'property_path' => 'facturas',
                    'query_builder' => function (EntityRepository $er) use($cliente,$facturas)  {
                         return $er->facturasPendientes($cliente,$facturas);
    }
                );
    
            $form->add('facturas', EntityType::class, $formOptions);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. Ingresos
                $data = $event->getData();
                if (isset($data))
                {
                    $formModifier($event->getForm(), $data->getCliente(),$data->getFacturas());
                }
            }
        );

        $builder->get('cliente')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $cliente = $event->getForm()->getData();
                $facturas = $event->getForm()->getParent()->getData()->getFacturas();
                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $cliente,$facturas);
            }
        );   */
            
       
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Multiservices\PayPayBundle\Entity\Ingresos',
            //'attr' => array('ng-submit'=>"processForm(\$event,'ingresos')")
        ));
    }
}
