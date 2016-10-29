<?php

/**
 * Description of newPHPClass
 *
 * @author Rene Arias <renearias@arxis.la>
 */
namespace AppBundle\Security\Core\User;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseUserProvider;
use AppBundle\Entity\Usuario;
use Symfony\Component\Security\Core\User\UserInterface;
use HWI\Bundle\OAuthBundle\Security\Core\Exception\AccountNotLinkedException;

class MyFOSUBUserProvider extends BaseUserProvider
{
    /**
     * {@inheritDoc}
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        if (!$user instanceof Usuario) {
            throw new UnsupportedUserException(sprintf('Expected an instance of FOS\UserBundle\Model\User, but got "%s".', get_class($user)));
        }
        // get property from provider configuration by provider name
        // , it will return `facebook_id` in that case (see service definition below)
        $property = $this->getProperty($response);
        
        // Symfony <2.5 BC
        if (method_exists($this->accessor, 'isWritable') && !$this->accessor->isWritable($user, $property)
            || !method_exists($this->accessor, 'isWritable') && !method_exists($user, 'set'.ucfirst($property))) {
            throw new \RuntimeException(sprintf("Class '%s' must have defined setter method for property: '%s'.", get_class($user), $property));
        }
        
        $username = $response->getUsername(); // get the unique user identifier

        //we "disconnect" previously connected users
        if (null !== $previousUser = $this->userManager->findUserBy(array($property => $username))) {
            // set current user id and token to null for disconnect
            // ...
            $this->disconnect($previousUser, $response);
            //$this->userManager->updateUser($previousUser);
        }
        // we connect current user, set current user id and token
        // ...
        $this->accessor->setValue($user, $property, $username);
        
        $this->userManager->updateUser($user);
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        
        $userEmail = $response->getEmail();
        $username = $response->getUsername();
        //$user = $this->userManager->findUserByEmail($userEmail);
        $user = $this->userManager->findUserBy(array($this->getProperty($response) => $username));
        
        if (null === $user || null === $username) {
            throw new AccountNotLinkedException(sprintf("User '%s' not found.", $username));
        }

        // if null just create new user and set it properties
       /* if (null === $user) {
            $username = $response->getRealName();
            $user = new Usuario();
            $user->setUsername($username);
            $user->setEmail($userEmail);
            $user->setEmailCanonical($userEmail);
            $user->setEnabled(true);
            

            // ... save user to database

           // return $user;
        }*/
        // else update access token of existing user
        $serviceName = $response->getResourceOwner()->getName();
        $setter = 'set' . ucfirst($serviceName) . 'AccessToken';
        $user->$setter($response->getAccessToken());//update access token

        return $user;
    }
}