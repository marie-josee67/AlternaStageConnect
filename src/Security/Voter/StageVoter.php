<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

final class StageVoter extends Voter
{
    public const UPDATE = 'STAGE_UPDATE';
    public const DELETE = 'STAGE_DELETE';

    protected function supports(string $attribute, mixed $subject): bool
    {
        // remplacez par votre propre logique
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [[self::UPDATE, self::DELETE]])
            && $subject instanceof \App\Entity\Stage;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
              // utilisateur connecter
              $user = $token->getUser();

              // vérification si l'utilisateur est bien connecter
              // Si l'utilisateur est anonyme, n'accordez pas l'accès
              if (!$user instanceof UserInterface) {
                  return false;
              }
      
              // ... (Vérifier les conditions et valide la permission de la requête) ...
              switch ($attribute) {
      
                  // droit de mise à jour
                  case self::UPDATE:
                      //est-ce que le createby d'alternance === utilisateur connecté
                      /** @var Stage $subject */
                      if($subject->getCreatedBy() === $user) { return true; }
                      
                      break;
      
                  // droit de suppression
                  case self::DELETE:
                      /** @var Stage $subject */
                      if($subject->getCreatedBy() === $user) { return true; }
                      
                      break;
              }
      
              return false;
    }
}
