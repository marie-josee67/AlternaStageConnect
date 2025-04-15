<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

final class StageVoter extends Voter
{
    public const EDIT = 'POST_EDIT';
    public const VIEW = 'POST_VIEW';

    protected function supports(string $attribute, mixed $subject): bool
    {
        // remplacez par votre propre logique
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::EDIT, self::VIEW])
            && $subject instanceof \App\Entity\Stage;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // Si l'utilisateur est anonyme, n'accordez pas l'accès
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (Vérifier les conditions et revenir à la permission de la subvention) ...
        switch ($attribute) {
            case self::EDIT:
               // logique pour déterminer si l'utilisateur peut modifier
                // Renvoie vrai ou faux
                break;

            case self::VIEW:
                // logique pour déterminer si l'utilisateur peut afficher
                // Renvoie vrai ou faux
                break;
        }

        return false;
    }
}
