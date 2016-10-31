<?php

namespace Multiservices\PayPayBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class FacturasDatatable
 *
 * @package Multiservices\PayPayBundle\Datatables
 */
class FacturasDatatable extends AbstractDatatableView
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
                    'route' => $this->router->generate('facturas',['page'=>'new']),
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
            'url' => $this->router->generate('facturas_results'),
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
            ->add('legal', 'column', array(
                'title' => 'Legal',
            ))
            ->add('emitido', 'datetime', array(
                'title' => 'Emitido',
            ))
            ->add('vencimiento', 'datetime', array(
                'title' => 'Vencimiento',
            ))
            ->add('pago', 'datetime', array(
                'title' => 'Pago',
            ))
            ->add('estado', 'column', array(
                'title' => 'Estado',
            ))
            ->add('tipo', 'column', array(
                'title' => 'Tipo',
            ))
            ->add('cobrado', 'column', array(
                'title' => 'Cobrado',
            ))    
           /* ->add('credito', 'datetime', array(
                'title' => 'Credito',
            ))
            /*->add('iva_igv', 'column', array(
                'title' => 'Iva_igv',
            ))*/
            /*->add('sub_total', 'column', array(
                'title' => 'Sub_total',
            ))*/
            ->add('descuento', 'column', array(
                'title' => 'Descuento',
            ))    
            ->add('total', 'column', array(
                'title' => 'Total',
            ))
            /*->add('forma', 'column', array(
                'title' => 'Forma',
            ))*/
           
            
            /*->add('statevencido', 'column', array(
                'title' => 'Statevencido',
            ))*/
            
            /* ->add(null, 'action', array(
                'title' => $this->translator->trans('datatables.actions.title'),
                'actions' => array(
                    array(
                        'route' => 'facturas',
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
                        'route' => 'facturas_edit',
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
        return 'Multiservices\PayPayBundle\Entity\Facturas';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'facturas_datatable';
    }
}
