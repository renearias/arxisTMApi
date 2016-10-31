<?php
namespace Multiservices\NotifyBundle\Servicios;

use Doctrine\ORM\EntityManager;
use Multiservices\NotifyBundle\Entity\Notificaciones;
use Multiservices\ArxisBundle\Entity\Usuario;

/**
 * Description of timeago
 *
 * @author Rene Arias <renearias@multiservices.com.ec>
 */

class Notificador
{
    private $entityManager;
    
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    function notificar($accion,$titulo,$user,$data=null)
    {
       $em=$this->entityManager;
       $notificacion=New Notificaciones();
       $notificacion->setActionid($em->getRepository('NotifyBundle:Actions')->find($accion));
       $notificacion->setNotificacionuser($user);
       $notificacion->setNotificacionrole(1);
       
       $notificacion->setNotificaciontitulo($titulo);
       $notificacion->setNotificacion($accion);
       $notificacion->setNotificaciontimestamp(time());
       $notificacion->setNotificacionestado(0);
       $notificacion->setVariables($data);
       $em->persist($notificacion);
       $em->flush();
       }
       
    function crearNotificacion($accion,$titulo,$user,$data=null)
    {
       $em=$this->entityManager;
       $notificacion=New Notificaciones();
       $notificacion->setActionid($em->getRepository('NotifyBundle:Actions')->find($accion));
       $notificacion->setNotificacionuser($user);
       $notificacion->setNotificacionrole(1);
       
       $notificacion->setNotificaciontitulo($titulo);
       $notificacion->setNotificacion($accion);
       $notificacion->setNotificaciontimestamp(time());
       $notificacion->setNotificacionestado(0);
       $notificacion->setVariables($data);
       return $notificacion;
    }   
    
    function notificarAVarios($accion,$titulo,array $usuarios,$data=null)
    {
       $em=$this->entityManager;
       $commonAction=$em->getRepository('NotifyBundle:Actions')->find($accion);
       foreach($usuarios as $user)
       {
       $notificacion=New Notificaciones();
       $notificacion->setActionid($commonAction);
       $notificacion->setNotificacionuser($user);
       $notificacion->setNotificacionrole(1);
       $notificacion->setNotificaciontitulo($titulo);
       $notificacion->setNotificacion($accion);
       $notificacion->setNotificaciontimestamp(time());
       $notificacion->setNotificacionestado(0);
       $notificacion->setVariables($data);
       $em->persist($notificacion);
       }
       $em->flush();  
       return $notificacion;
    }
    
    function preNotificarAVarios($accion,$titulo,array $usuarios,$data=null)
    {
       $notificaciones=[];
       $em=$this->entityManager;
       $commonAction=$em->getRepository('NotifyBundle:Actions')->find($accion);
       foreach($usuarios as $user)
       {
       $notificacion=New Notificaciones();
       $notificacion->setActionid($commonAction);
       $notificacion->setNotificacionuser($user);
       $notificacion->setNotificacionrole(1);
       $notificacion->setNotificaciontitulo($titulo);
       $notificacion->setNotificacion($accion);
       $notificacion->setNotificaciontimestamp(time());
       $notificacion->setNotificacionestado(0);
       $notificacion->setVariables($data);
       $notificaciones[]=$notificacion;
       }
       return $notificaciones;
    }
    public static function arrayNotificacionFirebase(Notificaciones $notificacion){
        return ['uid'=>$notificacion->getNotificacionuser()->getId(),
                                             'username'=>$notificacion->getNotificacionuser()->getUsername(),
                                             'date'=>$notificacion->getNotificaciontimestamp()*(-1),
                                             'icon'=>$notificacion->getIcon(),
                                             'read'=>$notificacion->isRead(),
                                             'message'=>$notificacion->getMessage(),
                                            ];
    }
    public static function formatoNotificacionFirebase(Notificaciones $notificacion){
        $notificacionFirebase=[$notificacion->getId()=>
                                            self::arrayNotificacionFirebase($notificacion)];
        return $notificacionFirebase;
    }
    public static function formatoVariasNotificacionesFirebase($notificaciones){
        
        $notificacionesFirebase=[];
        foreach ($notificaciones as $notificacion)
        {
        $notificacionesFirebase[$notificacion->getId()]=self::arrayNotificacionFirebase($notificacion);
                                    
        }
        return $notificacionesFirebase;
    }
    public static function formatoBulkNotificacionesFirebase($bulkNotificaciones){
        
        $notificacionesFirebase=[];
        foreach ($bulkNotificaciones as $notificacion)
        {
        $notificacionesFirebase[$notificacion->getNotificacionuser()->getUsername()][$notificacion->getId()]=self::arrayNotificacionFirebase($notificacion);
                                    
        }
        return $notificacionesFirebase;
    }
    public static function notificarAFirebase($notificacion, $firebase)
    {
        $firebase->update(self::formatoNotificacionFirebase($notificacion),
                          'notificaciones/'.$notificacion->getNotificacionuser()->getUsername());
    }
    
    public static function sincronizarUsuarioFirebase($notificaciones, $firebase, $username)
    {
        $firebase->update(self::formatoVariasNotificacionesFirebase($notificaciones), 'notificaciones/'.$username);
    }
    
    public static function notificarBulkFirebase($notificaciones, $firebase)
    {
        $notificacionesPreparadas=self::formatoBulkNotificacionesFirebase($notificaciones);
        {
            
            foreach ($notificacionesPreparadas as $username =>$notificacionesUserPreparadas ) {
                $firebase->update($notificacionesUserPreparadas, 'notificaciones/'.$username);
            }
        }
        
    }
   
}

