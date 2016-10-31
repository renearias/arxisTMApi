<?php

namespace Arxis\ContableBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class ContactoDatatable
 *
 * @package Arxis\ContableBundle\Datatables
 */
class ContactoDatatable extends AbstractDatatableView
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = array())
    {
       /* $this->topActions->set(array(
            'start_html' => '<div class="row"><div class="col-sm-3">',
            'end_html' => '<hr></div></div>',
            'actions' => array(
                array(
                    'route' => $this->router->generate('contacto',['page'=>'new']),
                    'label' => $this->translator->trans('datatables.actions.new'),
                    'icon' => 'glyphicon glyphicon-plus',
                    'attributes' => array(
                        'rel' => 'tooltip',
                        'title' => $this->translator->trans('datatables.actions.new'),
                        'class' => 'btn btn-primary',
                        'role' => 'button'
                    ),
                )
            )
        ));*/

        $this->features->set(array(
            'auto_width' => true,
            'defer_render' => false,
            'info' => true,
            'jquery_ui' => false,
            'length_change' => true,
            'ordering' => true,
            'paging' => true,
            'processing' => true,
            'scroll_x' => false,
            'scroll_y' => '',
            'searching' => true,
            'server_side' => true,
            'state_save' => false,
            'delay' => 0,
            'extensions' => array()
        ));

        $this->ajax->set(array(
            'url' => $this->router->generate('contacto_results'),
            'type' => 'GET'
        ));

        $this->options->set(array(
            'display_start' => 0,
            'defer_loading' => -1,
            //'dom' => 'lfrtip',
            'dom' => "<'row'<'col-sm-4 col-xs-12'f><'col-sm-4 col-xs-12'B><'col-sm-4 col-xs-12'l>>" .
                    "<'row'<'col-sm-12'rt>>" .
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            'length_menu' => array(10, 25, 50, 100),
            'order_classes' => true,
            'order' => array(array(0, 'asc')),
            'order_multi' => true,
            'page_length' => 10,
            'paging_type' => Style::FULL_NUMBERS_PAGINATION,
            'renderer' => '',
            'scroll_collapse' => false,
            'search_delay' => 0,
            'state_duration' => 7200,
            'stripe_classes' => array(),
            'class' => Style::BASE_STYLE,
            'individual_filtering' => true,
            'individual_filtering_position' => 'foot',
            'use_integration_options' => false,
            'force_dom' => true
        ));

        $this->columnBuilder
            ->add('id', 'column', array(
                'title' => 'Id',
            ))
            ->add('paisid', 'column', array(
                'title' => 'Paisid',
            ))
            ->add('codigo', 'column', array(
                'title' => 'Codigo',
            ))
            ->add('identificacion', 'column', array(
                'title' => 'Identificacion',
            ))
            ->add('nombre', 'column', array(
                'title' => 'Nombre',
            ))
            ->add('direccion', 'column', array(
                'title' => 'Direccion',
            ))
            ->add('nombrecomercial', 'column', array(
                'title' => 'Nombrecomercial',
            ))
            ->add('telefonos', 'column', array(
                'title' => 'Telefonos',
            ))
            ->add('ciudad', 'column', array(
                'title' => 'Ciudad',
            ))
            ->add('fax', 'column', array(
                'title' => 'Fax',
            ))
            ->add('pais', 'column', array(
                'title' => 'Pais',
            ))
            ->add('contacto', 'column', array(
                'title' => 'Contacto',
            ))
            ->add('registroempresarial', 'column', array(
                'title' => 'Registroempresarial',
            ))
            ->add('email', 'column', array(
                'title' => 'Email',
            ))
            ->add('actividadeconomica', 'column', array(
                'title' => 'Actividadeconomica',
            ))
            ->add('clasecontribuyente', 'column', array(
                'title' => 'Clasecontribuyente',
            ))
            ->add('notas', 'column', array(
                'title' => 'Notas',
            ))
            ->add('cliente', 'column', array(
                'title' => 'Cliente',
            ))
            ->add('proveedor', 'column', array(
                'title' => 'Proveedor',
            ))
            ->add('vendedor', 'column', array(
                'title' => 'Vendedor',
            ))
            ->add('empleado', 'column', array(
                'title' => 'Empleado',
            ))
            ->add('transportista', 'column', array(
                'title' => 'Transportista',
            ))
            ->add('recaudador', 'column', array(
                'title' => 'Recaudador',
            ))
            ->add('tipoidentificacionid.id', 'column', array(
                'title' => 'Tipoidentificacionid Id',
            ))
            ->add('tipoidentificacionid.codigo', 'column', array(
                'title' => 'Tipoidentificacionid Codigo',
            ))
            ->add('tipoidentificacionid.nombre', 'column', array(
                'title' => 'Tipoidentificacionid Nombre',
            ))
            ->add('tipoidentificacionid.codigocompraats', 'column', array(
                'title' => 'Tipoidentificacionid Codigocompraats',
            ))
            ->add('tipoidentificacionid.codigoventaats', 'column', array(
                'title' => 'Tipoidentificacionid Codigoventaats',
            ))
            ->add('tipopersonaid.id', 'column', array(
                'title' => 'Tipopersonaid Id',
            ))
            ->add('tipopersonaid.codigo', 'column', array(
                'title' => 'Tipopersonaid Codigo',
            ))
            ->add('tipopersonaid.nombre', 'column', array(
                'title' => 'Tipopersonaid Nombre',
            ))
            /* ->add(null, 'action', array(
                'title' => $this->translator->trans('datatables.actions.title'),
                'actions' => array(
                    array(
                        'route' => 'contacto',
                        'route_parameters' => array(
                            'page' => 'id'
                        ),
                        'label' => $this->translator->trans('datatables.actions.show'),
                        'icon' => 'glyphicon glyphicon-eye-open',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => $this->translator->trans('datatables.actions.show'),
                            'class' => 'btn btn-primary btn-xs',
                            'role' => 'button'
                        ),
                    ),
                    array(
                        'route' => 'contacto_edit',
                        'route_parameters' => array(
                            'page' => 'id'
                        ),
                        'label' => $this->translator->trans('datatables.actions.edit'),
                        'icon' => 'glyphicon glyphicon-edit',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => $this->translator->trans('datatables.actions.edit'),
                            'class' => 'btn btn-primary btn-xs',
                            'role' => 'button'
                        ),
                    )
                )
            ))*/
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'Arxis\ContableBundle\Entity\Contacto';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'contacto_datatable';
    }
}
