<?php

/*
 *  Todos los derechos reservados
 */
namespace AppBundle\Form\Handler;

/**
 * Description of FormHandler
 *
 * @author Rene Arias <renearias@arxis.la>
 */

use AppBundle\Exception\InvalidFormException;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormTypeInterface;

class FormHandler implements FormHandlerInterface
{
    /**
     * 
     * @var ObjectManager
     */
    private $em;
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    /**
     * @var FormTypeInterface
     */
    private $formType;
    /**
     * FormHandler constructor.
     * @param FormFactoryInterface $formFactory
     * @param FormTypeInterface $formType
     */
    public function __construct(ObjectManager $objectManager, FormFactoryInterface $formFactory, FormTypeInterface $formType)
    {
        $this->em = $objectManager;
        $this->formFactory = $formFactory;
        $this->formType = $formType;
    }
    /**
     * @param mixed  $object
     * @param array  $parameters
     * @param string $method
     * @param array  $options
     * @return mixed
     * @throws InvalidFormException
     */
    public function processForm($object, array $parameters, $method, array $options = [])
    {
        $options_replaced = array_replace_recursive([
            'method'            => $method,
            'csrf_protection'   => false,
        ], $options);
        $form = $this->formFactory->create(get_class($this->formType), $object, $options_replaced);
        $form->submit($parameters, 'PATCH' !== $method);
        if (!$form->isValid()) {
            throw new InvalidFormException($form);
        }
        $data = $form->getData();
        $this->em->persist($data);
        $this->em->flush();
        return $data;
    }
    
    /**
    * @param $object
    * @return mixed
    */
    public function get($object)
    {
        return $object;
        //return $this->repository->find($id);
    }
    
    /**
     * @param array $parameters
     * @return mixed
     */
    public function post($object, array $parameters)
    {
        return $this->processForm(
            $object,
            $parameters,
            "POST"
        );
    }
    
    /**
     * @param mixed $object
     * @param array $parameters
     * @return mixed
     */
    public function put($object, array $parameters)
    {
        return $this->processForm(
            $object,
            $parameters,
            "PUT"
        );
    }
    
    /**
     * @param mixed $object
     * @param array $parameters
     * @return mixed
     */
    public function patch($object, array $parameters)
    {
        return $this->processForm(
            $object,
            $parameters,
            "PATCH"
        );
    }
    
    /**
     * @param mixed $resource
     * @return bool
     */
    public function delete($object)
    {
        $this->em->remove($object);
        $this->em->flush();
        return true;
    }
}