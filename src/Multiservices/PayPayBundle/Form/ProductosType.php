<?php

namespace Multiservices\PayPayBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ProductosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('referencia')
            ->add('descripcion')
            ->add('impuesto')
            ->add('descripcionCorta')
            ->add('stock')
            ->add('stockMinimo')
            ->add('avisoMinimo')
            ->add('tipo')
            ->add('datosProducto')
            ->add('fechaAlta', DateType::class)
           // ->add('codembalaje')
            ->add('unidadesCaja')
            ->add('precioTicket')
            ->add('modificarTicket')
            ->add('observaciones')
            ->add('precioCompra')
            ->add('precioAlmacen')
            ->add('precioTienda')
            ->add('precioPvp')
            ->add('precioIva')
            ->add('codigobarras')
            ->add('imagen')
            ->add('borrado')
            ->add('codubicacion')
            ->add('codproveedor1')
           // ->add('codproveedor2')
            ->add('codfamilia')
           // ->add('atributos')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Multiservices\PayPayBundle\Entity\Productos',
            //'attr' => array('ng-submit'=>"processForm(\$event,'productos')")
        ));
    }
}
