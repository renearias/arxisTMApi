<?php

namespace Multiservices\PayPayBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Context\SnippetAcceptingContext;
use Doctrine\ORM\EntityManagerInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Behat\Behat\Tester\Exception\PendingException;
use Multiservices\PayPayBundle\Entity\Ingresos;

class IngresosContext implements Context, SnippetAcceptingContext
{
    /**
     * @var UserManagerInterface
     */
    protected $userManager;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * UserContext constructor.
     * @param UserManagerInterface $userManager
     * @param EntityManagerInterface $em
     */
    public function __construct(UserManagerInterface $userManager, EntityManagerInterface $em)
    {
        $this->userManager = $userManager;
        $this->em = $em;
        
    }

    /**
     * @Given estos ingresos con los siguientes detalles:
     */
    public function estosIngresosConLosSiguientesDetalles(TableNode $ingresos)
    {
        
        foreach ($ingresos->getColumnsHash() as $key => $val) {

            $ingreso= new Ingresos();

            $ingreso->setDescripcion($val['descripcion']);
            $ingreso->setMonto($val['monto']);
            $ingreso->setReferencia($val['referencia']);
            $fp=$this->em->getRepository('PayPayBundle:FormasPagos')->find($val['formapago']);
            $ingreso->setFormaPago($fp);
            $cli=$this->em->getRepository("ArxisContableBundle:Contacto")->find($val['cliente']);
            $ingreso->setCliente($cli);
            
            $this->em->persist($ingreso);
            $this->em->flush();
            $qb = $this->em->createQueryBuilder();

            $query = $qb->update('PayPayBundle:Ingresos', 'i')
                ->set('i.id', $qb->expr()->literal($val['id']))
                //->set('i.formapago', $qb->expr()->literal($val['formapago']))    
                ->where('i.descripcion =:descripcion')
                
                ->setParameters([
                    'descripcion' => $val['descripcion'],
                    //'email' => $val['email']
                ])
                ->getQuery()
            ;

            $query->execute();
        }
    }
    
    
    
            
}