<?php

namespace Multiservices\PayPayBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Context\SnippetAcceptingContext;
use Doctrine\ORM\EntityManagerInterface;
use Behat\Behat\Tester\Exception\PendingException;
use Multiservices\PayPayBundle\Entity\FormasPagos;
use Arxis\ContableBundle\Entity\Tipoidentificacion;
use Arxis\ContableBundle\Entity\Tipopersona;
use Arxis\ContableBundle\Entity\Contacto;

class FormasPagoContext implements Context, SnippetAcceptingContext
{


    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * UserContext constructor.
     * @param UserManagerInterface $userManager
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Given estas formas de pago con los siguientes detalles:
     */
    public function estosFormasDePagoConLosSiguientesDetalles(TableNode $formasdepago)
    {
        foreach ($formasdepago->getColumnsHash() as $key => $val) {

            
            $formadepago= new FormasPagos();

            $formadepago->setDescripcion($val['descripcion']);
            $formadepago->setFormaPago($val['formapago']);
            $this->em->persist($formadepago);
            $this->em->flush();
            $qb = $this->em->createQueryBuilder();

            $query = $qb->update('PayPayBundle:FormasPagos', 'f')
                ->set('f.id', $qb->expr()->literal($val['id']))
                ->where('f.formaPago =:formapago')
                //->andWhere('u.email = :email')
                ->setParameters([
                    'formapago' => $val['formapago'],
                    //'email' => $val['email']
                ])
                ->getQuery()
            ;

            $query->execute();
        }
    }

    
    /**
     * @Given estos tipos de personas con los siguientes detalles:
     */
    public function estosTiposDePersonasConLosSiguientesDetalles(TableNode $tiposdepersona)
    {
        foreach ($tiposdepersona->getColumnsHash() as $key => $val) {

            
            $tipodepersona= new Tipopersona();

            
            $tipodepersona->setNombre($val['nombre']);
            $tipodepersona->setCodigo($val['codigo']);
            $this->em->persist($tipodepersona);
            $this->em->flush();    
            $qb = $this->em->createQueryBuilder();

            $query = $qb->update('ArxisContableBundle:Tipopersona', 't')
                ->set('t.id', $qb->expr()->literal($val['id']))
                ->where('t.codigo =:codigo')
                //->andWhere('u.email = :email')
                ->setParameters([
                    'codigo' => $val['codigo'],
                    //'email' => $val['email']
                ])
                ->getQuery()
            ;

            $query->execute();
        }
        
    }
    
     /**
     * @Given estos tipos de identificacion con los siguientes detalles:
     */
    public function estosTiposDeIdentificacionConLosSiguientesDetalles(TableNode $tiposdeidentificacion)
    {
        foreach ($tiposdeidentificacion->getColumnsHash() as $key => $val) {

            
            $tipodeidentificacion= new Tipoidentificacion();

            $tipodeidentificacion->setCodigo($val['codigo']);
            $tipodeidentificacion->setNombre($val['nombre']);
            $tipodeidentificacion->setCodigocompraats($val['codigocompraats']);
            $tipodeidentificacion->setCodigoventaats($val['codigoventaats']);
            $this->em->persist($tipodeidentificacion);
            $this->em->flush();
            $qb = $this->em->createQueryBuilder();

            $query = $qb->update('ArxisContableBundle:Tipoidentificacion', 't')
                ->set('t.id', $qb->expr()->literal($val['id']))
                ->where('t.codigo =:codigo')
                //->andWhere('u.email = :email')
                ->setParameters([
                    'codigo' => $val['codigo'],
                    //'email' => $val['email']
                ])
                ->getQuery()
            ;

            $query->execute();
        }
    }
    
    
    /**
     * @Given estos contactos con los siguientes detalles:
     */
    public function estosContactosConLosSiguientesDetalles(TableNode $contactos)
    {
        foreach ($contactos->getColumnsHash() as $key => $val) {

            
            $contacto= new Contacto();

            $contacto->setCodigo($val['codigo']);
            $contacto->setNombre($val['nombre']);
            $contacto->setNombrecomercial($val['nombrecomercial']);
            $contacto->setPais($val['pais']);
            $contacto->setActividadeconomica($val['actividadeconomica']);
            $contacto->setCiudad($val['ciudad']);
            $contacto->setClasecontribuyente($val['clasecontribuyente']);
            $contacto->setCliente($val['cliente']);
            $contacto->setContacto($val['contacto']);
            $contacto->setDireccion($val['direccion']);
            $contacto->setEmail($val['email']);
            $contacto->setEmpleado($val['empleado']);
            $contacto->setFax($val['fax']);
            $contacto->setIdentificacion($val['identificacion']);
            $contacto->setNotas($val['notas']);
            $contacto->setProveedor($val['proveedor']);
            $contacto->setRegistroempresarial($val['registroempresarial']);
            $contacto->setRecaudador($val['recaudador']);
            $contacto->setTelefonos($val['telefonos']);
            $contacto->setTransportista($val['transportista']);
            $contacto->setVendedor($val['vendedor']);
            
            
            
            
            $tp=$this->em->getRepository("ArxisContableBundle:Tipopersona")->find($val['tipopersona']);
            $contacto->setTipopersonaid($tp);
            $ti=$this->em->getRepository("ArxisContableBundle:Tipoidentificacion")->find($val['tipoidentificacion']);
            $contacto->setTipoidentificacionid($ti);
            
            
            $this->em->persist($contacto);
            $this->em->flush();
            $qb = $this->em->createQueryBuilder();

            $query = $qb->update('ArxisContableBundle:Contacto', 'c')
                ->set('c.id', $qb->expr()->literal($val['id']))
                ->where('c.nombre =:nombre')
                //->andWhere('u.email = :email')
                ->setParameters([
                    'nombre' => $val['nombre'],
                    //'email' => $val['email']
                ])
                ->getQuery()
            ;

            $query->execute();
        }
    }
}