<?php

namespace Multiservices\TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Multiservices\TaskBundle\Form\Type\StateTaskType;
use JMS\Serializer\Annotation as Serializer;

/**
 * Tarea
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Multiservices\TaskBundle\Entity\TareaRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class Tarea
{
    public function __construct()
    {
        $this->created=New \Datetime();
        $this->children=New \Doctrine\Common\Collections\ArrayCollection();
    }
    
      public function __toString()
    {
       return $this->tarea;
    }
    
    
     /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var Tarea
     *
     * @ORM\ManyToOne(targetEntity="Tarea", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     **/
    private $parent;
    /**
     * @ORM\OneToMany(targetEntity="Tarea", mappedBy="parent")
     **/
    private $children;
    /**
     * @var string
     *
     * @ORM\Column(name="tarea", type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\SerializedName("title")
     */
    
    private $tarea;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="text",length=50, nullable=false)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expired_date", type="datetime")
     */

    private $expired_date;

    /**
     * @var \AppBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Usuario")
     * @ORM\JoinColumn(name="createdby", referencedColumnName="id")
     */
    private $createdby;

    /**
     * @var \AppBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Usuario")
     * @ORM\JoinColumn(name="assignedto", referencedColumnName="id")
     */
    private $assignedto;

    /**
     * @var \AppBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Usuario")
     * @ORM\JoinColumn(name="finishby", referencedColumnName="id")
     */
    private $finishby;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="finished", type="datetime", nullable=true)
     */
    private $finished;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="isurgent", type="boolean", options={"default":false})
     */
    private $isurgent=false;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="isread", type="boolean", options={"default":false})
     */
    private $isread=false;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="time_estimate", type="integer", options={"default":0})
     */
    private $timeEstimate=0;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", options={"default":200})
     */
    private $priority=200;

    /**
     * @var string
     * @DoctrineAssert\Enum(entity="\Multiservices\TaskBundle\Form\Type\StateTaskType")
     * @ORM\Column(name="state", type="StateTaskType", length=1, nullable=true)
     */
    private $state=StateTaskType::CREADA;
    
    
    /**
     * 
     * @Serializer\Expose()
     * @Serializer\SerializedName("status")
     * @Serializer\Accessor(getter="getStatus")
     */
    private $status;
    public function getStatus(){
        if ($this->isurgent)
        {return 'URGENTE';}
        else
        {return 'NORMAL';}
    }
    
    /**
     * 
     * @Serializer\Expose()
     * @Serializer\SerializedName("class")
     * @Serializer\Accessor(getter="getClass")
     */
    private $class;
    public function getClass(){
        if ($this->getStatus()=='URGENTE')
        {return 'progress progress-md progress-striped';}
        else
        {return 'progress-xs';}
    }
    
    /**
     * 
     * @Serializer\Expose()
     * @Serializer\SerializedName("width")
     * @Serializer\Accessor(getter="getWidth")
     */
    private $width;
    public function getWidth(){
        if ($this->state==StateTaskType::FINALIZADA)
        {return 100;}
        if ($this->state== StateTaskType::PENDIENTE)
        {return 50;}
        else
        {return 10;}
    }

    /**
     * 
     * @Serializer\Expose()
     * @Serializer\SerializedName("last_update")
     * @Serializer\Accessor(getter="getLastUpdate")
     * @Serializer\Type("DateTime<'d/m/y'>")
     */
    private $last_update;
    public function getLastUpdate(){
        return New \DateTime();
    }
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getExpiredDate()
    {
        return $this->expired_date;
    }

    /**
     * @param \DateTime $expired_date
     */
    public function setExpiredDate($expired_date)
    {
        $this->expired_date = $expired_date;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

 
    /**
     * @return Tarea
     */
    public function getParent() {
        return $this->parent;
    }
    /**
     * 
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getChildren() {
        return $this->children;
    }
    /**
     * 
     * @param \Multiservices\TaskBundle\Entity\Tarea $parent
     * @return \Multiservices\TaskBundle\Entity\Tarea
     */
    public function setParent(Tarea $parent) {
        $this->parent = $parent;
        return $this;
    }
    /**
     * 
     * @param \Doctrine\Common\Collections\ArrayCollection $children
     * @return \Multiservices\TaskBundle\Entity\Tarea
     */
    public function setChildren(\Doctrine\Common\Collections\ArrayCollection $children) {
        $this->children = $children;
        return $this;
    }
        
    /**
     * Set tarea
     *
     * @param string $tarea
     * @return Tarea
     */
    public function setTarea($tarea)
    {
        $this->tarea = $tarea;

        return $this;
    }

    /**
     * Get tarea
     *
     * @return string 
     */
    public function getTarea()
    {
        return $this->tarea;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Tarea
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set createdby
     *
     * @param integer $createdby
     * @return Tarea
     */
    public function setCreatedby(\AppBundle\Entity\Usuario $createdby)
    {
        $this->createdby = $createdby;

        return $this;
    }

    /**
     * Get createdby
     *
     * @return \AppBundle\Entity\Usuario 
     */
    public function getCreatedby()
    {
        
        return $this->createdby;
    }
    
    /**
     * Set createdby
     *
     * @param integer $createdby
     * @return Tarea
     */
    public function setAssignedto(\AppBundle\Entity\Usuario $assignedto)
    {
        $this->assignedto = $assignedto;

        return $this;
    }

    /**
     * Get createdby
     *
     * @return \AppBundle\Entity\Usuario 
     */
    public function getAssignedto()
    {
        return $this->assignedto;
    }
    

    /**
     * Set finishby
     *
     * @param \AppBundle\Entity\Usuario $finishby
     * @return Tarea
     */
    public function setFinishby(\AppBundle\Entity\Usuario $finishby)
    {
        $this->finishby = $finishby;

        return $this;
    }

    /**
     * Get finishby
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getFinishby()
    {
        return $this->finishby;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Tarea
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set finished
     *
     * @param \DateTime $finished
     * @return Tarea
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;

        return $this;
    }

    /**
     * Get finished
     *
     * @return \DateTime 
     */
    public function getFinished()
    {
        return $this->finished;
    }
    /**
     * 
     * @param boolean $isurgent
     * @return Tarea
     */
    public function setIsurgent($isurgent) {
        $this->isurgent = $isurgent;
        return $this;
    }
    /**
     * 
     * @return boolean
     */
    public function getIsurgent() {
        return $this->isurgent;
    }
    
    /**
     * 
     * @param boolean $isread
     * @return Tarea
     */
    public function setIsread($isread) {
        $this->isread = $isread;
        return $this;
    }
    /**
     * 
     * @return boolean
     */
    public function getIsread() {
        return $this->isread;
    }
     /**
     * Set state
     *
     * @param string $state
     * @return Tarea
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }
    /**
     * Get parentid
     * @return Tarea
     */
    public function getParentid() {
        return $this->parentid;
    }
    /**
     * 
     * @return integer
     */
    public function getTimeEstimate() {
        return $this->timeEstimate;
    }
    /**
     * 
     * @return integer
     */
    public function getPriority() {
        return $this->priority;
    }
    /**
     * 
     * @param Tarea $parentid
     * @return Tarea
     */
    public function setParentid(Tarea $parentid) {
        $this->parentid = $parentid;
        return $this;
    }
    /**
     * 
     * @param integer $timeEstimate
     * @return \Multiservices\TaskBundle\Entity\Tarea
     */
    public function setTimeEstimate($timeEstimate) {
        $this->timeEstimate = $timeEstimate;
        return $this;
    }
    /**
     * 
     * @param integer $priority
     * @return \Multiservices\TaskBundle\Entity\Tarea
     */
    public function setPriority($priority) {
        $this->priority = $priority;
        return $this;
    }

    
        
    
    /**
     * @ORM\ManyToOne(targetEntity="Tasktemplate")
     * @ORM\JoinColumn(name="tasktemplate", referencedColumnName="id")
     **/
    private $tasktemplate;
    
    /**
     * Set tasktemplate
     *
     * @param \Multiservices\TaskBundle\Entity\Tasktemplate $tasktemplate
     * @return Tarea
     */
    public function setTasktemplate(\Multiservices\TaskBundle\Entity\Tasktemplate $tasktemplate)
    {
        $this->tasktemplate = $tasktemplate;

        return $tasktemplate;
    }

    /**
     * Get tasktemplate
     *
     * @return \Multiservices\TaskBundle\Entity\Tasktemplate
     */
    public function getTasktemplate()
    {
        return $this->tasktemplate;
    }
    
    
   
}
