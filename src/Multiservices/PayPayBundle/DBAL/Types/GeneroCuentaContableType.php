<?php
/*
 *  Todos los derechos reservados
 */

/**
 * Description of GeneroCuentaContableType
 *
 * @author Rene Arias <renearias@arxis.la>
 */
namespace Multiservices\PayPayBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class GeneroCuentaContableType extends AbstractEnumType{
    
    const GRUPO    = 'Grupo';
    const DETALLE = 'Detalle';
    

    protected static $choices = [
        self::GRUPO   => 'Grupo',
        self::DETALLE => 'Detalle',
    ];

    
}
