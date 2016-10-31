<?php

/*
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

/**
 * Description of LoadFormasDePagoData
 *
 * @author Rene Arias <renearias@arxis.la>
 */

namespace Multiservices\PayPayBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Multiservices\PayPayBundle\Entity\FormasPagos;
use Multiservices\NotifyBundle\ActionData\ActionParameters;

class LoadFormasDePagoData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        
        $formasdepago=$this->loadFormasDePago($manager);
        
        foreach($formasdepago as $formadepago)
        {    
          $manager->persist($formadepago);
        }
        $manager->flush();
    }
    
    private function loadFormasDePago(ObjectManager $manager)
    {
        $formasdepago=[];
        
        $efectivo=$manager->getRepository('PayPayBundle:FormasPagos')->findByFormaPago('EFECTIVO');
        $banco=$manager->getRepository('PayPayBundle:FormasPagos')->findByFormaPago('BANCO');
        if (!$efectivo)
        {
          $efectivo = new FormasPagos();
          $efectivo->setFormaPago("EFECTIVO");
          $efectivo->setDescripcion("Efectivo al momento de la compra");
          $formasdepago[]=$efectivo; 
        }
        if (!$banco)
        {
          $banco = new FormasPagos();
          $banco->setFormaPago("BANCO");
          $banco->setDescripcion("Recaudacion en Banco");
          $formasdepago[]=$banco; 
        }
        
            
        return $formasdepago;
    }
}