<?php
/**
 * Created by PhpStorm.
 * User: Etudiant0
 * Date: 03/07/2018
 * Time: 12:02
 */

namespace App\User;


use App\Entity\Newsletter;
use App\Entity\User;
use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;

class UserSubscriber implements EventSubscriberInterface
{
    private $entityManager;

    /**
     * UserSubscriber constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return
        [
            SecurityEvents::INTERACTIVE_LOGIN => 'onSecurityInteractiveLogin',
            UserEvents::USER_CREATED          => 'onUserCreated',
            UserEvents::USER_UPDATED          => 'onUserUpdated',
            UserEvents::USER_DELETED          => 'onUserDeleted',
        ];
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        /**
         * @var User $user
         */
        $user = $event->getAuthenticationToken()->getUser();

        if( $user instanceof User )
        {
            $user->setLastConnectionDate();

            //$this->entityManager->persist($user);
            $this->entityManager->flush();
        }

    }

    public function onUserCreated( UserEvent $event )
    {
        $newsletter = new Newsletter();

        $newsletter->setEmail($event->getUser()->getEmail());

        $this->entityManager->persist($newsletter);
        $this->entityManager->flush();
    }
}