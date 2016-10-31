<?php
/*
 *  Todos los derechos reservados
 */

/**
 * Description of ClaseContribuyenteType
 *
 * @author Rene Arias <renearias@arxis.la>
 */
namespace Arxis\ContableBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class ClaseContribuyenteType extends AbstractEnumType{
    
    const ESPECIAL    = 'Especial';
    const RISE = 'RISE';
    const OTROS  = 'Otros';
    

    protected static $choices = [
        self::ESPECIAL   => 'Especial',
        self::RISE => 'RISE',
        self::OTROS  => 'Otros'
        
    ];

    
}
