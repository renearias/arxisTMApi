<?php

namespace Multiservices\NotifyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Multiservices\NotifyBundle\TimerService\timeago;

/**
 * Activity
 *
 * @ORM\Table(name="activity")
 * @ORM\Entity(repositoryClass="Multiservices\NotifyBundle\Entity\ActivityRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class Activity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false,options={"comment":"Primary Key: Unique watchdog event ID."})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * options={"comment":"The users.uid of the user who triggered the event."}
     * 
     * @var \Multiservices\ArxisBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="\Multiservices\ArxisBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="uid", referencedColumnName="id", nullable=false)
     * })
     * @Serializer\Expose
     * @Serializer\Groups({"activities"})
     */
    private $uid;

    /**
     * @var string
     *
     * @ORM\Column(name="utype", type="string", length=20, nullable=false,options={"comment":""})
     */
    private $utype;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false,options={"comment":""})
     */
    private $username;

    /**
     * @var \Multiservices\NotifyBundle\Entity\Actions
     *
     * @ORM\ManyToOne(targetEntity="\Multiservices\NotifyBundle\Entity\Actions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="actionid", referencedColumnName="aid")
     * })
     * @Serializer\Expose
     * @Serializer\Groups({"activities"})
     */
    private $actionid;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=true,options={"comment":"Text of log message to be passed into the t() function."})
     * @Serializer\Expose
     * @Serializer\Accessor(getter="getMessage")
     * @Serializer\Groups({"activities"})
     */
    private $message;

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
     * @ORM\Column(name="location", type="text", length=65535, nullable=true,options={"comment":"URL of the origin of the event."})
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="referer", type="text", length=65535, nullable=true,options={"comment":"URL of referring page."})
     */
    private $referer;

    /**
     * @var string
     *
     * @ORM\Column(name="hostname", type="string", length=128, nullable=true,options={"comment":"Hostname of the user who triggered the event."})
     */
    private $hostname;

    /**
     * @var integer
     *
     * @ORM\Column(name="timestamp", type="integer", nullable=true,options={"default":0,"comment":"Unix timestamp of when event occurred."})
     * @Serializer\Expose
     * @Serializer\Groups({"activities"})
     */
    private $timestamp = 0;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set uid
     *
     * @param \Multiservices\ArxisBundle\Entity\Usuario $uid
     * @return Activity
     */
    public function setUid(\Multiservices\ArxisBundle\Entity\Usuario $uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Get uid
     *
     * @return \Multiservices\ArxisBundle\Entity\Usuario
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set utype
     *
     * @param string $utype
     * @return Activity
     */
    public function setUtype($utype)
    {
        $this->utype = $utype;

        return $this;
    }

    /**
     * Get utype
     *
     * @return string 
     */
    public function getUtype()
    {
        return $this->utype;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Activity
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }
    /**
     * 
     * @param \Multiservices\NotifyBundle\Entity\Actions $actionid
     * @return Activity
     */
    function setActionid(\Multiservices\NotifyBundle\Entity\Actions $actionid) {
        $this->actionid = $actionid;
        return $this;
    }
    /**
     * 
     * @return \Multiservices\NotifyBundle\Entity\Actions
     */
    function getActionid() {
        return $this->actionid;
    }
    

    /**
     * Set message
     *
     * @param string $message
     * @return Activity
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set variables
     *
     * @param string $variables
     * @return Activity
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
     * @return Activity
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
     * @return Activity
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
     * Set location
     *
     * @param string $location
     * @return Activity
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set referer
     *
     * @param string $referer
     * @return Activity
     */
    public function setReferer($referer)
    {
        $this->referer = $referer;

        return $this;
    }

    /**
     * Get referer
     *
     * @return string 
     */
    public function getReferer()
    {
        return $this->referer;
    }

    /**
     * Set hostname
     *
     * @param string $hostname
     * @return Activity
     */
    public function setHostname($hostname)
    {
        $this->hostname = $hostname;

        return $this;
    }

    /**
     * Get hostname
     *
     * @return string 
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * Set timestamp
     *
     * @param integer $timestamp
     * @return Activity
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return integer 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }
    
    /**
    
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("date")
     * @Serializer\Groups({"activities"})
     */
     public function getDate()
     {
          $timeago=new timeago($this->timestamp);
          return $timeago->tiempo;
         
     }
}
