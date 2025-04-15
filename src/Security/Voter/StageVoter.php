<?php

namespace App\Security\Voter;

use App\Entity\Stage;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

final class StageVoter extends Voter
{
    public const UPDATE = 'STAGE_UPDATE';
    public const DELETE = 'STAGE_DELETE';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [self::UPDATE, self::DELETE])
            && $subject instanceof Stage;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
    
        if (!$user instanceof UserInterface) {
            return false;
        }
    
        $roles = $token->getRoleNames();
    
        switch ($attribute) {
            case self::UPDATE:
                // Si le user est le créateur
                if ($subject->getCreatedBy() === $user) {
                    return true;
                }
    
                // Si le user a un rôle élevé
                if (in_array('ROLE_MODO', $roles) || in_array('ROLE_ADMIN', $roles) || in_array('ROLE_SUPERADMIN', $roles)) {
                    return true;
                }
    
                break;
            case self::DELETE:
                // Si le user est le créateur
                if ($subject->getCreatedBy() === $user) {
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
