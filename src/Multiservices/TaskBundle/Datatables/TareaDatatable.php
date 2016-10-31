<?php

namespace Multiservices\TaskBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;
use Multiservices\LexBundle\Form\Type\EstadoCasoType;
use Multiservices\TaskBundle\Form\Type\StatetaskType;
/**
 * Class TareaDatatable
 *
 * @package Multiservices\LexBundle\Datatables
 */
class TareaDatatable extends AbstractDatatableView
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable()
    {
        $this->features->setFeatures(array(
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
            'delay' => 0
        ));
            $this->setUseSDom(true);
                    $this->ajax->setOptions(array(
            'url' => $this->router->generate('tarea_results'),
            'type' => 'GET'
        ));
            
        $this->options->setOptions(array(
            'display_start' => 0,
            'defer_loading' => -1,
            'dom' => 'lfrtip',
            'sdom'=>'<"H"<"dt-toolbar"<"col-xs-12 col-sm-5"f><"col-sm-4 col-xs-6 hidden-xs"><"col-xs-6 col-sm-3"l>r>>t<"F"<"dt-toolbar-footer"<"col-xs-12 col-sm-6"i><"col-xs-12 col-sm-6"p>>>',
            'length_menu' => array(10, 25, 50, 100),
            'order_classes' => true,
            'order' => [[4, 'desc']],
            'order_multi' => true,
            'page_length' => 10,
            'paging_type' => Style::FULL_NUMBERS_PAGINATION,
            'renderer' => '',
            'scroll_collapse' => false,
            'search_delay' => 0,
            'state_duration' => 7200,
            'stripe_classes' => array(),
            'responsive' => false,
            'class' => Style::BASE_STYLE.' projects-table '.Style::BOOTSTRAP_3_STYLE.' table-striped table-bordered table-hover',
            'individual_filtering' => false,
            'individual_filtering_position' => 'head',
            'use_integration_options' => true,
            'detail_child_rows' => true
        ));

        $this->columnBuilder
                ->add(null, 'detailscontrol', array(
                        'title' => '',
                    ))
                ->add('id', 'rowdetail', array('title' => 'Codigo',
                                            'visible'=>false))
                ->add('tarea', 'column', array('title' => 'tarea',))
                ->add('descripcion', 'rowdetail', array('title' => 'Descripcion',))
                ->add('created', 'datetime', array('title' => 'Creado a',))
                
                ->add('createdby.name', 'column', array('title' => 'Creada por',))
                ->add('assignedto.name', 'column', array('title' => 'Asignado a',))
                ->add('finishby.name', 'column', array('title' => 'Finalizada por',))
                ->add('finished', 'datetime', array('title' => 'Finalizada a',))
                ->add('state', 'column', array('title' => 'Estado',))
                //->add('etapa', 'column', array('title' => 'Etapa',))
                //->add('observacion', 'column', array('title' => 'Observacion',))
              //  ->add('ciudadId.ciudnombre', 'column', array('title' => 'Ciudad',))
               // ->add('naturaleza.naturaleza', 'column', array('title' => 'Materia',))
               // ->add('tribunal.tribunal', 'column', array('title' => 'Tribunal',))
                // ->add('estado', 'rowdetail', array('title' => 'Estado',))
                // ->add('clientesCaso.nombre', 'arrayrowdetail', array('title' => 'Clientes del Caso',
  //                                       'data' => 'clientesCaso[, ].nombre',
    //                                     'arraydatafield' => 'nombre',
      //                                   'arraydata' => 'clientesCaso',
       //                                   //'render'=>"'' == data? 'No registra Movimientos' : 'Registra '+row.movimientoscliente.length+' movimiento(s)';"
       //                                   ))
        //        ->add('clientesCaso.apellido', 'arrayrowdetail', array('title' => 'Clientes A del Caso',
         //                                'data' => 'clientesCaso[, ].apellido',
          //                               'visibleonrow'=>false,
           //                              'arraydatafield' => 'apellido',
            //                              'arraydata' => 'clientesCaso',
                                          //'render'=>"'' == data? 'No registra Movimientos' : 'Registra '+row.movimientoscliente.length+' movimiento(s)';"
             //                           ))
         //        ->add('responsablesCaso.name', 'arrayrowdetail', array('title' => 'Responsables del Caso',
          ///                               'data' => 'responsablesCaso[, ].name',
           //                              'arraydatafield' => 'name',
            //                              'arraydata' => 'responsablesCaso',
             //                             //'render'=>"'' == data? 'No registra Movimientos' : 'Registra '+row.movimientoscliente.length+' movimiento(s)';"
              //                            ))
                ->add(null, 'action', array(
                'title' => 'Acciones',
                'start_html' => '<div class="wrapper">',
                'end_html' => '</div>',
                'actions' => array(
                    array(
                        'route' => 'tarea_show',
                        'route_parameters' => array(
                            'id' => 'id'
                        ),
                        'label' => 'Mostrar',
                       // 'toajax'=>true,
                        'icon' => 'glyphicon glyphicon-eye-open',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => 'Mostrar',
                            'class' => 'btn btn-default btn-xs',
                            'role' => 'button'
                        ),
                        'role' => 'ROLE_USER',
                        //'render_if' => array('visible')
                    ),
                     array(
                        'route' => 'tarea_finish',
                        'route_parameters' => array(
                            'id' => 'id'
                        ),
                        'label' => 'Terminar',
                       // 'toajax'=>true,
                        'icon' => 'glyphicon glyphicon-ok',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => 'terminar',
                            'class' => 'btn btn-default btn-xs',
                            'role' => 'button'
                        ),
                        'role' => 'ROLE_USER',
                        //'render_if' => array('visible')
                    ),
                    array(
                        'route' => 'tarea_edit',
                        'route_parameters' => array(
                            'id' => 'id'
                        ),
                        'label' => 'Editar',
                        //'toajax'=>true,
                        'icon' => 'glyphicon glyphicon-edit',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => 'Editar',
                            'class' => 'btn btn-primary btn-xs',
                            'role' => 'button'
                        ),
                        //'confirm' => true,
                        //'confirm_message' => 'Esta Seguro?',
                        'role' => 'ROLE_ADMIN',
                    )
                )
            ));
                
    }
    /**
     * {@inheritdoc}
     */
    public function getLineFormatter()
    {
        $formatter = function($line){
             $line["state"] = StateTaskType::getReadableHtmlValue($line["state"]);
            return $line;
        };

        return $formatter;
     
    }
    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'Multiservices\TaskBundle\Entity\Tarea';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'tarea_datatable';
    }
}
