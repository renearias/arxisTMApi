<?php

namespace Multiservices\NotifyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Multiservices\NotifyBundle\TimerService\timeago;
/**
 * Notificaciones
 *
 * @ORM\Table(name="notificaciones", indexes={@ORM\Index(name="IDX_6FFCB213768C2B6", columns={"notificacionuser"})})
 * @ORM\Entity(repositoryClass="Multiservices\NotifyBundle\Entity\NotificacionesRepository")
 * @ORM\EntityListeners({"Multiservices\NotifyBundle\EventListener\NotificacionesListener"})
 * @Serializer\ExclusionPolicy("all")
 */
class Notificaciones
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="notificacionrole", type="string", length=20, nullable=false)
     */
    private $notificacionrole;

    /**
     * @var integer
     *
     * @ORM\Column(name="notificaciontimestamp", type="integer", nullable=false)
     */
    private $notificaciontimestamp;
    /**
     * 
     * @Serializer\Expose()
     * @Serializer\SerializedName("message")
     * @Serializer\Accessor(getter="getMessage")
     */
     private $message;
     public function getMessage()
     {  
         $parameters=$this->getActionid()->getParameters();
          if (isset($parameters['vars'])&&(!empty($parameters['vars'])))
          {
              $vars=$this->getActionid()->getParameters()['vars'];
              $message=$this->getActionid()->getLabel();
              //var_dump($this->variables);
              foreach ($vars as $var)
              {
                  //var_dump($var);
                  
                 if (is_array($this->variables) && isset($this->variables[$var]))
                 {
                     if ($var!='urlUser')
                     {    
                     $message=str_replace('%'.$var.'%', '<strong>'.$this->variables[$var].'</strong>',$message);
                     }else
                     {
                     $message=str_replace('%'.$var.'%', $this->variables[$var], $message);    
                     }

                 }
                 elseif (is_object($this->variables) && isset($this->variables->$var))
                 {
                     if ($var!='urlUser')
                     {    
                     $message=str_replace('%'.$var.'%', '<strong>'.$this->variables->$var.'</strong>',$message);
                     }else
                     {
                     $message=str_replace('%'.$var.'%', $this->variables->$var, $message);    
                     }
                 }
              }
              return $message;
              
          }
          else
          {
          return str_replace('%title%', '<strong>'.$this->notificaciontitulo.'</strong>',$this->getActionid()->getLabel());
          }
         
     }
     
     /**
     *
     * @Serializer\Expose()
     * @Serializer\SerializedName("icon")
     * @Serializer\Accessor(getter="getIcon")
     */
     private $icon;
     public function getIcon()
     {
          $actionParams=  $this->getActionid()->getParameters();
          return $actionParams['icon'];
         
     }
     
     /**
    
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("date")
     */
     public function getDate()
     {
          $timeago=new timeago($this->notificaciontimestamp);
          return $timeago->tiempo;
         
     }
  


     /**
     * @var string
     *
     * @ORM\Column(name="notificaciontitulo", type="string", length=200, nullable=false)
     */
    private $notificaciontitulo;

    /**
     * @var string
     *
     * @ORM\Column(name="notificacion", type="string", length=1000, nullable=false)
     */
    private $notificacion;
     /**
     * @var string
     *
     * @ORM\Column(name="variables", type="json_array", nullable=true,options={"comment":"Serialized array of variables that match the message string and that is passed into the t() function."})
     */
    private $variables;

    /**
     * @var integer
     *
     * @ORM\Column(name="severity", type="smallint", length=1, nullable=true, options={"unsigned":true,"default":0,"comment":"The severity level of the event; ranges from 0 (Emergency) to 7 (Debug)"})
     */
    private $severity=0;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true,options={"default":"","comment":"Link to view the result of the event."})
     */
    private $link = '';

    /**
     * @var string
     *
     * @ORM\Column(name="notificacionimg", type="string", length=100, nullable=true)
     */
    private $notificacionimg;

    /**
     * @var string
     *
     * @ORM\Column(name="notificacionestado", type="string", length=8, nullable=false)
     * 
     * @Serializer\Expose()
     * @Serializer\SerializedName("read")
     * @Serializer\Accessor(getter="isRead")
     * @Serializer\Type("boolean")
     
     */
    private $notificacionestado;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="sincronizada", type="boolean", nullable=false)
     * 
     * Serializer\Expose()
     * Serializer\SerializedName("sync")
     * 
     * Serializer\Type("boolean")
     
     */
    private $sincronizada=false;
    
    public function isRead() {
        if (intval($this->notificacionestado)==1)
        {return true;}
        else
        {return false;}
    }

    /**
     * @var \Multiservices\ArxisBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="\Multiservices\ArxisBundle\Entity\Usuario", inversedBy="notificaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="notificacionuser", referencedColumnName="id")
     * })
     */
    private $notificacionuser;
    
    /**
     * @var \Multiservices\NotifyBundle\Entity\Actions
     *
     * @ORM\ManyToOne(targetEntity="\Multiservices\NotifyBundle\Entity\Actions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="actionid", referencedColumnName="aid")
     * })
     */
    private $actionid;



    /**
     * Get codnotificacion
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set notificacionrole
     *
     * @param string $notificacionrole
     * @return Notificaciones
     */
    public function setNotificacionrole($notificacionrole)
    {
        $this->notificacionrole = $notificacionrole;

        return $this;
    }

    /**
     * Get notificacionrole
     *
     * @return string 
     */
    public function getNotificacionrole()
    {
        return $this->notificacionrole;
    }

    /**
     * Set notificaciontimestamp
     *
     * @param integer $notificaciontimestamp
     * @return Notificaciones
     */
    public function setNotificaciontimestamp($notificaciontimestamp)
    {
        $this->notificaciontimestamp = $notificaciontimestamp;

        return $this;
    }

    /**
     * Get notificaciontimestamp
     *
     * @return integer 
     */
    public function getNotificaciontimestamp()
    {
        return $this->notificaciontimestamp;
    }

    /**
     * Set notificaciontitulo
     *
     * @param string $notificaciontitulo
     * @return Notificaciones
     */
    public function setNotificaciontitulo($notificaciontitulo)
    {
        $this->notificaciontitulo = $notificaciontitulo;

        return $this;
    }

    /**
     * Get notificaciontitulo
     *
     * @return string 
     */
    public function getNotificaciontitulo()
    {
        return $this->notificaciontitulo;
    }

    /**
     * Set notificacion
     *
     * @param string $notificacion
     * @return Notificaciones
     */
    public function setNotificacion($notificacion)
    {
        $this->notificacion = $notificacion;

        return $this;
    }

    /**
     * Get notificacion
     *
     * @return string 
     */
    public function getNotificacion()
    {
        return $this->notificacion;
    }
    /**
     * Set variables
     *
     * @param string $variables
     * @return Notificaciones
     */
    public function setVariables($variables)
    {
        $this->variables = $variables;

        return $this;
    }

    /**
     * Get variables
     *
     * @return string 
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     * Set severity
     *
     * @param boolean $severity
     * @return Notificaciones
     */
    public function setSeverity($severity)
    {
        $this->severity = $severity;

        return $this;
    }

    /**
     * Get severity
     *
     * @return boolean 
     */
    public function getSeverity()
    {
        return $this->severity;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Notificaciones
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }
    /**
     * Set notificacionimg
     *
     * @param string $notificacionimg
     * @return Notificaciones
     */
    public function setNotificacionimg($notificacionimg)
    {
        $this->notificacionimg = $notificacionimg;

        return $this;
    }

    /**
     * Get notificacionimg
     *
     * @return string 
     */
    public function getNotificacionimg()
    {
        return $this->notificacionimg;
    }

    /**
     * Set notificacionestado
     *
     * @param string $notificacionestado
     * @return Notificaciones
     */
    public function setNotificacionestado($notificacionestado)
    {
        $this->notificacionestado = $notificacionestado;

        return $this;
    }

    /**
     * Get notificacionestado
     *
     * @return string 
     */
    public function getNotificacionestado()
    {
        return $this->notificacionestado;
    }

    /**
     * Set notificacionuser
     *
     * @param \Multiservices\ArxisBundle\Entity\Usuario $notificacionuser
     * @return Notificaciones
     */
    public function setNotificacionuser(\Multiservices\ArxisBundle\Entity\Usuario $notificacionuser = null)
    {
        $this->notificacionuser = $notificacionuser;

        return $this;
    }

    /**
     * Get notificacionuser
     *
     * @return \Multiservices\NotifyBundle\Entity\Usuario 
     */
    public function getNotificacionuser()
    {
        return $this->notificacionuser;
    }
    /**
     * 
     * @return Actions
     */
    function getActionid() {
        return $this->actionid;
    }
    /**
     * 
     * @param \Multiservices\NotifyBundle\Entity\Actions $actionid
     * @return Notificaciones
     */
    function setActionid(\Multiservices\NotifyBundle\Entity\Actions $actionid) {
        $this->actionid = $actionid;
        return $this;
    }



    /**
     * Set sincronizada
     *
     * @param boolean $sincronizada
     *
     * @return Notificaciones
     */
    public function setSincronizada($sincronizada)
    {
        $this->sincronizada = $sincronizada;

        return $this;
    }

    /**
     * Get sincronizada
     *
     * @return boolean
     */
    public function getSincronizada()
    {
        return $this->sincronizada;
    }
}
