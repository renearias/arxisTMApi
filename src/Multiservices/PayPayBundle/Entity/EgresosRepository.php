<?php

namespace Multiservices\PayPayBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * EgresosRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EgresosRepository extends EntityRepository
{
    public function last()
        {
            return $this->getEntityManager()
                ->createQuery('SELECT i'
                        . ' FROM PayPayBundle:Egresos i '
                      
                        . ' ORDER BY i.fecha DESC'
                        )
                //->setParameter(":ingreso", $ingreso)
                ->setMaxResults(10)
                ->getResult();
        }
     public function sumLast()
        {
            return $this->getEntityManager()
                ->createQuery('SELECT sum(i.monto)'
                        . ' FROM PayPayBundle:Egresos i '
                      
                        . ' ORDER BY i.fecha DESC'
                        )
                //->setParameter(":ingreso", $ingreso)
                ->setMaxResults(10)
                ->getSingleScalarResult();
        }
}
