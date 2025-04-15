<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

final class UserVoter extends Voter
{
    public const UPDATE = 'USER_UPDATE';
    public const DELETE = 'USER_DELETE';

    protected function supports(string $attribute, mixed $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::UPDATE, self::DELETE])
            && $subject instanceof \App\Entity\User;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
    
        if (!$user instanceof \App\Entity\User) {
            return false;
        }
    
        $roles = $token->getRoleNames();
    
        switch ($attribute) {
            case self::UPDATE:
                // Si le user est le créateur
                if ($subject->getId() === $user->getId())  {
                    return true;
                }
                // Si le user a un rôle élevé
                if (in_array('ROLE_MODO', $roles) || in_array('ROLE_ADMIN', $roles) || in_array('ROLE_SUPERADMIN', $roles)) {
                    return true;
                }
    
                break;
            case self::DELETE:
                // Si le user est le créateur
                if ($subject->getUser()?->getId() === $user->getId()) {
                    return true;
                }
                // Si le user a un rôle élevé
                if (in_array('ROLE_MODO', $roles) || in_array('ROLE_ADMIN', $roles) || in_array('ROLE_SUPERADMIN', $roles)) {
                    return true;
                }
    
                break;
        }
    
        return false;
    }
}
