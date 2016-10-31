<?php

namespace Arxis\ContableBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('paisid')
            ->add('codigo')
            ->add('identificacion')
            ->add('nombre')
            ->add('direccion')
            ->add('nombrecomercial')
            ->add('telefonos')
            ->add('ciudad')
            ->add('fax')
            ->add('pais')
            ->add('contacto')
            ->add('registroempresarial')
            ->add('email')
            ->add('actividadeconomica')
            ->add('clasecontribuyente')
            ->add('notas')
            ->add('cliente')
            ->add('proveedor')
            ->add('vendedor')
            ->add('empleado')
            ->add('transportista')
            ->add('recaudador')
            ->add('tipoidentificacionid')
            ->add('tipopersonaid')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Arxis\ContableBundle\Entity\Contacto',
            'attr' => array('ng-submit'=>"processForm(\$event,'contacto')")
        ));
    }
}
