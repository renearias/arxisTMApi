<?php
/*
 *  Todos los derechos reservados
 */

/**
 * Description of EstadoEstablecimientoType
 *
 * @author Rene Arias <renearias@arxis.la>
 */
namespace Multiservices\PayPayBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class EstadoEstablecimientoType extends AbstractEnumType{
    
    const ABIERTO    = 'Abierto';
    const CERRADO = 'Cerrado';
    

    protected static $choices = [
        self::ABIERTO    => 'Abierto',
        self::CERRADO => 'Cerrado'
        
    ];

    
}
