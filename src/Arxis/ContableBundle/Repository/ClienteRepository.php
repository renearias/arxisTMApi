<?php

namespace Arxis\ContableBundle\Repository;

use Doctrine\ORM\EntityRepository;
//use Multiservices\PayPayBundle\DBAL\Types\EstadoFacturaType;
//use Multiservices\PayPayBundle\Entity\Ingresos;

class ClienteRepository extends EntityRepository
{
    
 
    public function clientesSimple()
    {
        return $this->getEntityManager()
            ->createQueryBuilder()->select('c.id, c.nombre')
                    ->from('ArxisContableBundle:Cliente','c')
                    ->getQuery()->getResult();

    }
    
    
   
}
