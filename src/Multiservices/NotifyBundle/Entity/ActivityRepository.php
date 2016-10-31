<?php
/**
 * Description of NotificacionesRepository
 *
 * @author Rene Arias <renearias@multiservices.com.ec>
 */
namespace Multiservices\NotifyBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ActivityRepository extends EntityRepository
{
    
   public function recentActivities()
    {
       $fecha=New \DateTime();
       $fechainiciohoy = new \DateTime($fecha->format('Y-m-d')); 
       $fechainicioayer = new \DateTime('yesterday'); 
       //$res=$fecha->diff($fechainiciohoy,true);
       //var_dump($res);
               
               
       return $this->getEntityManager()
            ->createQuery('SELECT a'
                    . ' FROM NotifyBundle:Activity a '
                    . 'where (a.timestamp between :fechaini and :fechafin) '
                    . ' ORDER BY a.timestamp DESC')
            ->setParameter(":fechaini", $fechainicioayer->getTimestamp())
            ->setParameter(":fechafin", $fecha->getTimestamp())
            ->getResult();
    }
    public function myActivities($user)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT a'
                    . ' FROM NotifyBundle:Activity a '
                    . 'where a.uid=:user'
                    . ' ORDER BY a.timestamp DESC')
            ->setParameter(":user", $user)
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
