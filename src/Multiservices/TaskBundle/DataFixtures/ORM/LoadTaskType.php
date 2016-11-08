<?php

/*
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

/**
 * Description of LoadTaskType
 *
 * @author Aular Wiljac
 */

namespace Multiservices\NotifyBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Multiservices\TaskBundle\Entity\TaskType;

class LoadTaskType implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $type=$this->loadTaskType();

        $manager->persist($type);

        $manager->flush();
    }
    
    private function loadTaskType()
    {
        $type = new TaskType();

        $type->setType("NORMAL");
        $type->setDescripcion("Tarea normal");
        $type->setData("{}");
            
        return $type;
    }
}