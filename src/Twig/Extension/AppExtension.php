<?php

namespace App\Twig\Extension;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;
use App\Twig\Runtime\HasRoleExtensionRuntime;

// ********************************************** permet de choisir le rôle de l'utilisateur **************************************** */
class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('has_role', [HasRoleExtensionRuntime::class, 'hasRole']),
        ];
    }

    public function getFunctions(): array
    {
        return [
          
        ];
    }
}
