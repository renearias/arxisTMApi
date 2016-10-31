<?php
/*
 *  Todos los derechos reservados
 */

/**
 * Description of CuentaContableType
 *
 * @author Rene Arias <renearias@arxis.la>
 */
namespace Multiservices\PayPayBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class CuentaContableType extends AbstractEnumType{
    
    const ACTIVO    = 'Activo';
    const PASIVO = 'Pasivo';
    const PATRIMONIO  = 'Patrimonio';
    const INGRESOS  = 'Ingresos';
    const EGRESOS        = 'Egresos';

    protected static $choices = [
        self::ACTIVO   => 'Activo',
        self::PASIVO => 'Pasivo',
        self::PATRIMONIO  => 'Patrimonio',
        self::INGRESOS  => 'Ingresos',
        self::EGRESOS         => 'Egresos'
    ];

    
}
