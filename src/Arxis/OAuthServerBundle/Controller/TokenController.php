<?php

/*
 * This file is part of the FOSOAuthServerBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Arxis\OAuthServerBundle\Controller;

use FOS\OAuthServerBundle\Controller\TokenController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use OAuth2\OAuth2;
use OAuth2\OAuth2ServerException;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;


class TokenController extends BaseController
{
    
    /**
     * 
     * @ApiDoc(
     *   resource = true,
     *   section="Login",
     *   description="Get a Bearer Token with credentials",
     *   filters={
     *      {"name"="grant_type", "dataType"="string", "pattern"="(password|https://facebook.com/)"}
     *   },
     *   requirements={
     *      {
     *          "name"="client_id",
     *          "dataType"="string",
     *          "requirement"="string",
     *          "description"="client id  defaultValue = '1_2fq6ri2xx4cgc8o8kgwwwgc0gk040cwwoww0k4gc0oksksgk0g'",
     *          "value"="1212"
     *      },
     *      {
     *          "name"="client_secret",
     *          "dataType"="string",
     *          "requirement"="string",
     *          "description"="client secret defaultValue= '5inlap0v5pgkg8co8o84gocwwk8wo84woskk08w08o08ooc804'"
     *      }
     *    },
     *   parameters={
     *      {"name"="username", "dataType"="string", "required"=false, "description"="username"},
     *      {"name"="password", "dataType"="string", "required"=false, "description"="password"}
     *   },
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when not found"
     *   }
     * )
     * 
     * @param Request $request
     *
     * @return Response
     * 
     */
    public function tokenAction(Request $request)
    {
        // Do whatever you like here
        $result = parent::tokenAction($request);
        // More custom code.
        return $result;
    }
}
