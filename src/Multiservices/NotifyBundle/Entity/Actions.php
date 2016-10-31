<?php

namespace Multiservices\NotifyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Multiservices\NotifyBundle\TimerService\timeago;

/**
 * Actions
 *
 * @ORM\Table(name="actions")
 * @ORM\Entity
 */
class Actions
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="aid", type="string", length=255, nullable=false,options={"default":"0","comment":"Primary Key: Unique actions ID."})
     * @Serializer\Groups({"activities"})
     * 
     * 
     */
    private $aid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=32, nullable=false,options={"default":"","comment":"The object that that action acts on (node, user, comment, system or custom types.)"})
     * @Serializer\Groups({"activities"})
     */
    private $type = '';

    /**
     * @var string
     *
     * @ORM\Column(name="callback", type="string", length=255, nullable=false,options={"default":"","comment":"The callback function that executes when the action runs."})
     */
    private $callback = '';

    /**
     * @var string
     *
     * @ORM\Column(name="parameters", type="json_array", nullable=false,options={"comment":"Parameters to be passed to the callback function."})
     * @Serializer\Groups({"activities"})
     */
    private $parameters;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255, nullable=false,options={"default":"0","comment":"Label of the action."})
     */
    private $label = '0';



    /**
     * Get aid
     *
     * @return string 
     */
    public function getAid()
    {
        return $this->aid;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Actions
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set callback
     *
     * @param string $callback
     * @return Actions
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;

        return $this;
    }

    /**
     * Get callback
     *
     * @return string 
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * Set parameters
     *
     * @param string $parameters
     * @return Actions
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * Get parameters
     *
     * @return string 
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Set label
     *
     * @param string $label
     * @return Actions
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set aid
     *
     * @param string $aid
     * @return Actions
     */
    public function setAid($aid)
    {
        $this->aid = $aid;

        return $this;
    }
    
    public function __toString() {
        return $this->label;
    }
    
}
