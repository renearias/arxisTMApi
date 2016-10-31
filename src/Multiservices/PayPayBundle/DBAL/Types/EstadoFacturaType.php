<?php
namespace Multiservices\PayPayBundle\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * Description of EstadoEquipoType
 *
 * @author Rene Arias <renearias@multiservices.com.ec>
 */
class EstadoFacturaType  extends AbstractEnumType
{
    const INDEFINIDO   = null;
    const PAGADA   = 'pagada';
    const NOPAGADA = 'No pagado';
    const VENCIDA ='vencido';
    const ANULADA ='anulada';
    
    

    protected static $choices = [
        
        self::INDEFINIDO=>'INDEFINIDO',
        self::PAGADA   => 'Pagada',
        self::NOPAGADA => 'No Pagado',
        self::VENCIDA => 'Vencida',
        self::ANULADA => 'Anulada'
    ];
    protected static $htmlchoices = [
        self::INDEFINIDO     => '<span class="label label-default">INDEFINIDO</span>',
        self::PAGADA     => '<span class="label label-success">Pagada</span>',
        self::NOPAGADA => '<span class="label label-warning">No Pagado</span>',
        self::VENCIDA => '<span class="label label-danger">Vencida</span>',
        self::ANULADA => '<span class="label label-danger">Anulada</span>',
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