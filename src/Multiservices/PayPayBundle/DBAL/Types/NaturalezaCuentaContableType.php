<?php
/*
 *  Todos los derechos reservados
 */

/**
 * Description of NaturalezaCuentaContableType
 *
 * @author Rene Arias <renearias@arxis.la>
 */
namespace Multiservices\PayPayBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class NaturalezaCuentaContableType extends AbstractEnumType{
    
    const DEUDORA    = 'Deudora';
    const ACREEDORA = 'Acreedora';
    

    protected static $choices = [
        self::DEUDORA   => 'Deudora',
        self::ACREEDORA => 'Acreedora',
    ];

    
}
