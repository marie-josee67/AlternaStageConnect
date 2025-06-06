<?php

namespace App\Security\Voter;

use App\Entity\Alternance;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

final class AlternanceVoter extends Voter
{
    public const UPDATE = 'ALTERNANCE_UPDATE';
    public const DELETE = 'ALTERNANCE_DELETE';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [self::UPDATE, self::DELETE])
            && $subject instanceof Alternance;
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
                if ($subject->getUser()?->getId() === $user->getId()) {
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

