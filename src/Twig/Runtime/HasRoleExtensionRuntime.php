<?php

namespace App\Twig\Runtime;

use Symfony\Component\Security\Core\Role\RoleHierarchyInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Twig\Extension\RuntimeExtensionInterface;

// ********************************************** Interface de gestion des rôles utilisateurs **************************************** */

class HasRoleExtensionRuntime implements RuntimeExtensionInterface
{
    // permet de connaitre le rôle de l'utilisateur et la hierarchie des rôles
    public function __construct(
        private RoleHierarchyInterface $roleHierarchy
    )
    {
        
    }

    public function hasRole(UserInterface $user, string $role): bool
    {
        return in_array($role,
        
        //verification que le rôle est dans le tableau des rôles
        $this->roleHierarchy->getReachableRoleNames($user->getRoles()));
    }
}