<?php
namespace Multiservices\PayPayBundle\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * Description of EstadoEquipoType
 *
 * @author Rene Arias <renearias@multiservices.com.ec>
 */
class EstadoClienteType  extends AbstractEnumType
{
    const INDEFINIDO   = null;
    const ACTIVO   = 'ACTIVO';
    const SUSPENDIDO = 'SUSPENDIDO';
    const RETIRADO ='RETIRADO';
    
    

    protected static $choices = [
        
        self::INDEFINIDO=>'INDEFINIDO',
        self::ACTIVO   => 'ACTIVO',
        self::SUSPENDIDO => 'SUSPENDIDO',
        self::RETIRADO => 'RETIRADO'
    ];
    protected static $htmlchoices = [
        self::INDEFINIDO     => '<span class="label label-default">INDEFINIDO</span>',
        self::ACTIVO     => '<span class="label label-success">ACTIVO</span>',
        self::SUSPENDIDO => '<span class="label label-warning">SUSPENDIDO</span>',
        self::RETIRADO => '<span class="label label-danger">RETIRADO</span>',
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