<?php

/*
 *  Todos los derechos reservados
 */

namespace AppBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Description of HttpContentTypeException
 *
 * @author Rene Arias <renearias@arxis.la>
 */


class HttpContentTypeException extends HttpException
{
    const ERROR_CODE = 415;
    const ERROR_MESSAGE = 'Invalid or missing Content-type header';

    public function __construct()
    {
        parent::__construct(self::ERROR_CODE, self::ERROR_MESSAGE);
    }
}