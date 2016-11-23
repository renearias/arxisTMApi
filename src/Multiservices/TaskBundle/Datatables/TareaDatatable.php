<?php

namespace Multiservices\TaskBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class TareaDatatable
 *
 * @package Multiservices\TaskBundle\Datatables
 */
class TareaDatatable extends AbstractDatatableView
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = array())
    {
        /*$this->topActions->set(array(
            'start_html' => '<div class="row"><div class="col-sm-3">',
            'end_html' => '<hr></div></div>',
            'actions' => array(
                array(
                    'route' => $this->router->generate('tarea_new'),
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
            'state_save' => false,
            'delay' => 0,
            'extensions' => array(),
            'highlight' => false,
            'highlight_color' => 'red'
        ));

        $this->ajax->set(array(
            'url' => $this->router->generate('tarea_results'),
            'type' => 'GET',
            'pipeline' => 0
        ));

        $this->options->set(array(
            'display_start' => 0,
            'defer_loading' => -1,
            'dom' => 'lfrtip',
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
            'class' => Style::BOOTSTRAP_3_STYLE,
            'individual_filtering' => true,
            'individual_filtering_position' => 'head',
            'use_integration_options' => true,
            'force_dom' => false,
            'row_id' => 'id'
        ));

        $this->columnBuilder
            ->add('id', 'column', array(
                'title' => 'Id',
                'name' => 'id'
            ))
            ->add('tarea', 'column', array(
                'title' => 'Tarea',
                'name' => 'tarea'
            ))
            ->add('created', 'datetime', array(
                'title' => 'Created',
            ))
            ->add('assignedto.name', 'column', array(
                'title' => 'Assignedto Name',
            ))    
            ->add('descripcion', 'column', array(
                'title' => 'Descripcion',
                'name' => 'descripcion'
            ))
            ->add('isurgent', 'boolean', array(
                'title' => 'Isurgent',
            ))
            ->add('state', 'column', array(
                'title' => 'State',
            ))
            ->add('finished', 'datetime', array(
                'title' => 'Finished',
            ))
            ->add('assignedto.id', 'column', array(
                'title' => 'Assignedto Id',
            ))
            /*->add('isread', 'boolean', array(
                'title' => 'Isread',
            ))*/
            ->add('timeEstimate', 'column', array(
                'title' => 'TimeEstimate',
            ))
            ->add('priority', 'column', array(
                'title' => 'Priority',
            ))
            /*->add('parent.id', 'column', array(
                'title' => 'Parent Id',
            ))
            ->add('parent.tarea', 'column', array(
                'title' => 'Parent Tarea',
            ))
            ->add('parent.descripcion', 'column', array(
                'title' => 'Parent Descripcion',
            ))
            ->add('parent.created', 'column', array(
                'title' => 'Parent Created',
            ))
            ->add('parent.finished', 'column', array(
                'title' => 'Parent Finished',
            ))
            ->add('parent.isurgent', 'column', array(
                'title' => 'Parent Isurgent',
            ))
            ->add('parent.isread', 'column', array(
                'title' => 'Parent Isread',
            ))
            ->add('parent.timeEstimate', 'column', array(
                'title' => 'Parent TimeEstimate',
            ))
            ->add('parent.priority', 'column', array(
                'title' => 'Parent Priority',
            ))
            ->add('parent.state', 'column', array(
                'title' => 'Parent State',
            ))*/
            ->add('createdby.id', 'column', array(
                'title' => 'Createdby Id',
            ))
            ->add('createdby.name', 'column', array(
                'title' => 'Createdby Name',
            ))
            /*->add('createdby.cargo', 'column', array(
                'title' => 'Createdby Cargo',
            ))
            ->add('createdby.trato', 'column', array(
                'title' => 'Createdby Trato',
            ))
            ->add('createdby.path', 'column', array(
                'title' => 'Createdby Path',
            ))
            ->add('createdby.telefono', 'column', array(
                'title' => 'Createdby Telefono',
            ))
            ->add('createdby.direccion', 'column', array(
                'title' => 'Createdby Direccion',
            ))
            ->add('createdby.created', 'column', array(
                'title' => 'Createdby Created',
            ))
            ->add('createdby.facebookId', 'column', array(
                'title' => 'Createdby FacebookId',
            ))
            ->add('createdby.facebookAccessToken', 'column', array(
                'title' => 'Createdby FacebookAccessToken',
            ))
            ->add('createdby.data', 'column', array(
                'title' => 'Createdby Data',
            ))*/
            ->add('assignedto.id', 'column', array(
                'title' => 'Assignedto Id',
            ))
            ->add('assignedto.name', 'column', array(
                'title' => 'Assignedto Name',
            ))
            /*->add('assignedto.cargo', 'column', array(
                'title' => 'Assignedto Cargo',
            ))
            ->add('assignedto.trato', 'column', array(
                'title' => 'Assignedto Trato',
            ))
            ->add('finishby.id', 'column', array(
                'title' => 'Finishby Id',
            ))
            ->add('finishby.name', 'column', array(
                'title' => 'Finishby Name',
            ))
            /*->add('finishby.cargo', 'column', array(
                'title' => 'Finishby Cargo',
            ))
            ->add('finishby.trato', 'column', array(
                'title' => 'Finishby Trato',
            ))
            
           /* ->add(null, 'action', array(
                'title' => $this->translator->trans('datatables.actions.title'),
                'actions' => array(
                    array(
                        'route' => 'tarea_show',
                        'route_parameters' => array(
                            'id' => 'id'
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
                        'route' => 'tarea_edit',
                        'route_parameters' => array(
                            'id' => 'id'
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
