<?php

namespace Multiservices\PayPayBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class IngresosDatatable
 *
 * @package Multiservices\PayPayBundle\Datatables
*/
class IngresosDatatable extends AbstractDatatableView
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = array())
    {
        $exporOptions=[
                       'columns'=> [0,1,2,4,5,7,8,9]
                       ];
        $this->callbacks->set(array(
            'footer_callback' => "PayPayBundle:Ingresos:footercallback.js.twig"
        ));
        
        $this->topActions->set(array(
            'start_html' => '<div class="row"><div class="col-sm-3">',
            'end_html' => '<hr></div></div>',
            'actions' => array(
                array(
                    'route' => $this->router->generate('ingresos',['page'=>'new']),
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
        ));

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
            'extensions' => array(
                'buttons' =>
                    array(
                        ['extend'=> 'copy',
                         'text'=> 'Copiar',
                          'className'=>'btn-primary',
                          'exportOptions'=>$exporOptions],
                        ['extend'=> 'excel',
                         'text'=> 'Excel',
                         'className'=>'btn-success',
                         'exportOptions'=>$exporOptions,
                         'footer'=>true ],
                        ['extend'=> 'pdf',
                         'text'=> 'PDF',
                         'className'=>'btn-danger',
                         'exportOptions'=>$exporOptions,
                         'footer'=>true ],
                        ['extend'=> 'print',
                         'text'=> 'Imprimir',
                         'className'=>'btn-primary',
                         'exportOptions'=>$exporOptions,
                            'footer'=>true],
                       [
                            'text' => 'Recargar',
                            'className'=>'btn btn-primary',
                            'action' => '::reload.js.twig'
                        ]
                   ),
                'responsive' => true)
        ));

        $this->ajax->set(array(
            'url' => $this->router->generate('ingresos_results'),
            'type' => 'GET'
        ));

        $this->options->set(array(
            'display_start' => 0,
            'defer_loading' => -1,
             'dom' => "<'row'<'col-sm-4 col-xs-12'f><'col-sm-4 col-xs-12'B><'col-sm-4 col-xs-12'l>>" .
                    "<'row'<'col-sm-12'rt>>" .
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            'length_menu' => array(10, 25, 50, 100,-1),
            'order_classes' => true,
            'order' => array(array(1, 'desc')),
            'order_multi' => true,
            'page_length' => 10,
            'paging_type' => Style::FULL_NUMBERS_PAGINATION,
            'renderer' => '',
            'scroll_collapse' => false,
            'search_delay' => 0,
            'state_duration' => 7200,
            'stripe_classes' => array(),
            'class' => Style::BOOTSTRAP_3_STYLE,
            'individual_filtering' => true,
            'individual_filtering_position' => 'head',
            'use_integration_options' => true,
            'force_dom' => true
        ));

        $this->columnBuilder
            ->add('id', 'column', array(
                'title' => 'Id',
                'width'=>'5em'
            ))
            ->add('fecha', 'datetime', array(
                'title' => 'Fecha',
                'date_format' => 'YYYY-MM-DD HH:MM', 
                'width'=>'8em'
            ))
            ->add('monto', 'column', array(
                'title' => 'Monto',
                'width'=>'6em'
            ))
            /*->add('descripcion', 'column', array(
                'title' => 'Descripcion',
            ))*/
            /*->add('referencia', 'column', array(
                'title' => 'Referencia',
            ))*/

            ->add('cliente.nombre', 'column', array(
                'title' => 'Cliente',
            ))

            ->add('formaPago.formaPago', 'column', array(
                'title' => 'Forma de Pago',
                'width'=>'5em'
            ))   
            
                
            /*->add('facturas.pension.estudiante.estudiante', 'array', array(
                'title' => 'Estudiante',
                'data' => 'facturas[, ].pension.estudiante.estudiante',
               // 'render'=>"function(data,type,row){return eliminarDuplicados(data.split(String.fromCharCode(44,32)));}"
            ))*/
                
             /*->add('facturas.pension.info', 'array', array(
                'data' => 'facturas[, ].pension.info',
                 'visible'=>false
            ))*/    
           /* ->add('facturas.id', 'array', array(
                'title' => 'Facturas',
               'data' => 'facturas[, ].id',
                'width'=>'6em'
            ))*/
            ->add('collectedby.name', 'column', array(
                'title' => 'Cobrado por',
                'width'=>'6em'
            )) 
            ->add('cliente.id', 'column', array(
                'visible' => false,
            ))     
           /* ->add(null, 'action', array(
                'title' => $this->translator->trans('datatables.actions.title'),
                'actions' => array(
                    array(
                        'route' => 'ingresos',
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
                        'route' => 'ingresos_edit',
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
    public function getLineFormatter()
    {
        $router = $this->router;
        
        $formatter = function($line) use ($router){
            
            if (isset($line["facturas"]))
            {
               
            foreach ($line["facturas"] as &$factura)
            {
                //$estudianteroute = $router->generate('estudiantes_show', array('id' => $factura["pension"]["estudiante"]["id"]));
                //$factura["pension"]["estudiante"]["estudiante"] = '<a href="'.$estudianteroute.'">'.$factura["pension"]["estudiante"]["estudiante"].'</a>';
                //$facturaroute = $router->generate('pension', array('page' => $factura["pension"]["id"]));
                //$factura["id"] = '<a rel="tooltip" title="'.$factura["pension"]["info"].'" href="'.$facturaroute.'">'.$factura["id"].'</a>';
            }
            }
            //$clienteroute = $router->generate('representantes', array('page' => $line["representante"]["id"]));
            //$line["cliente"]["nombre"] = '<a href="'.$representanteroute.'">'.$line["representante"]["representante"].'</a>';
       
            return $line;
        };

        return $formatter;
     
    }
    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'Multiservices\PayPayBundle\Entity\Ingresos';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ingresos_datatable';
    }
}
