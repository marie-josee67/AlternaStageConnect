<?php

namespace App\Twig\Runtime;

use Symfony\Component\Security\Core\Role\RoleHierarchyInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Twig\Extension\RuntimeExtensionInterface;

class HasRoleExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private RoleHierarchyInterface $roleHierarchy
    )
    {
        
    }

    public function hasRole(UserInterface $user, string $role): bool
    {
        return in_array($role,
        $this->roleHierarchy->getReachableRoleNames($user->getRoles()));
    }
}