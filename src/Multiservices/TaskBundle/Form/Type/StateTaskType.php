<?php

namespace Multiservices\TaskBundle\Form\Type;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;
/**
 * Description of EstadoCasosType
 *
 * @author Rene Arias <renearias@multiservices.com.ec>
 */
class StateTaskType extends AbstractEnumType {
  
    const INDEFINIDO    = NULL;
    const CREADA  = 'Creada';
    const PENDIENTE = 'Pendiente';
    const FINALIZADA  = 'Finalizada';
    
    protected static $choices = [
        
        self::CREADA   => 'CREADA',
        self::PENDIENTE => 'PENDIENTE',
        self::FINALIZADA => 'FINALIZADA',
        
    ];
        protected static $htmlchoices = [
        self::INDEFINIDO => '<span class="label label-default">Indefinida</span>',
        self::CREADA   => '<span class="label label-info">Creada</span>',
        self::PENDIENTE => '<span class="label label-warning">Pendiente</span>',
        self::FINALIZADA => '<span class="label label-success">Finalizada</span>',
    ];
     /**
     * Get readable choices for the ENUM field
     * @static
     * @return array Values for the ENUM field
     */
    public static function getHtmlChoices()
    {
        return static::$htmlchoices;
    }
    /**
     * Get value in readable format
     * @param string $value ENUM value
     * @static
     * @return string|null $value Value in readable format
     * @throws \InvalidArgumentException
     */
    public static function getReadableHtmlValue($value)
    {
        if (!isset(static::getHtmlChoices()[$value])) {
            $message = sprintf('Invalid value "%s" for ENUM type "%s"', $value, get_called_class());

            throw new \InvalidArgumentException($message);
        }

        return static::getHtmlChoices()[$value];
    }
}




