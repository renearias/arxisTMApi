<?php

/*
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

namespace AppBundle\Security\Authorization\Voter;

use AppBundle\Entity\Usuario;

use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Description of DistributivoVoter
 *
 * @author Rene Arias <renearias@arxis.la>
 */
class UserVoter extends Voter {
    
    const VIEW = 'DISTRIBUTIVO_VIEW';
    const EDIT = 'DISTRIBUTIVO_EDIT';

    protected function voteOnAttribute(TokenInterface $token, $requestedUser, array $attributes)
    {
        $user = $token->getUser();

        // get current logged in user
        $loggedInUser = $token->getUser();

        // make sure there is a user object (i.e. that the user is logged in)
        if ($loggedInUser === $requestedUser) {
            return VoterInterface::ACCESS_GRANTED;
        }

        return VoterInterface::ACCESS_DENIED;
    }


    
    
}
