<?php

namespace App\Security\Voter;

use App\Entity\Admin;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class AdminUserVoter extends Voter
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    // public const EDIT = 'Magazyn 1';
    // public const VIEW = 'POST_VIEW';

    protected function supports($attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['Magazyn 1'])
            && $subject instanceof Admin;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        dd($user);
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }
        if(!$subject instanceof Admin){
            throw new \LogicException('Subject is not an instanceof Admin?');
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'Magazyn 1':
                return $user === $subject || $this->security->isGranted('ROLE_ADMIN');
                // logic to determine if the user can EDIT
                // return true or false

                // break;
            // case self::VIEW:
            //     // logic to determine if the user can VIEW
            //     // return true or false
            //     break;
        }

        return false;
    }
}
