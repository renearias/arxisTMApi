<?php
/**
 * Description of NotificacionesRepository
 *
 * @author Rene Arias <renearias@multiservices.com.ec>
 */
namespace Multiservices\NotifyBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Multiservices\ArxisBundle\Entity\Usuario;

class NotificacionesRepository extends EntityRepository
{
    public function guardar($notificacion)
    {
         $em = $this->getEntityManager();
        $em->persist($notificacion);
       $em->flush();
    }
   public function inbox(Usuario $user)
    {  
        return $this->getEntityManager()
            ->createQueryBuilder()->select('n')
                    ->from('NotifyBundle:Notificaciones', 'n')
                    ->where('n.notificacionuser = :usuario ')
                     ->orderBy('n.notificaciontimestamp','DESC')
            ->setParameter(":usuario", $user)
            ->getQuery()
            ->getResult();
    }
   /* public function findMensajesRecibidos($user)
    {
    $em = $this->getEntityManager();

    $dql = "SELECT m
        FROM MultiservicesNotifyBundle:Mensajes m
        join m.destino u
        where u.id=:destinoid
        order by m.timesent desc";
    
    
    $query = $em->createQuery($dql);
    $query->setParameter('destinoid', $user);
    //$query->setParameter('title', '%' . $title . '%');


    
    $mensajes= $query->getResult();

    return $mensajes;
    }*/
}
