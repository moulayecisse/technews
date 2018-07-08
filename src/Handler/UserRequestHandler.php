<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 29/06/2018
 * Time: 10:42
 */

namespace App\Handler;

use App\Controller\HelperTrait;
use App\Entity\User;
use App\Factory\UserFactory;
use App\Request\UserRequest;
use App\Service\Event\UserEvent;
use App\Service\Event\UserEvents;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

class UserRequestHandler
{

    private $entityManager;
    private $userFactory;
    private $dispatcher;
    use HelperTrait;


    /**
     * UserRequestHandler constructor.
     * @param EntityManagerInterface $entityManager
     * @param UserFactory $userFactory
     * @param EventDispatcher $dispatcher
     * @internal param $em
     */
    public function __construct(EntityManagerInterface $entityManager, UserFactory $userFactory, EventDispatcher $dispatcher)
    {
        $this->entityManager = $entityManager;
        $this->userFactory = $userFactory;
        $this->dispatcher = $dispatcher;
    }


    /**
     * @param UserRequest $userRequest
     * @return User
     */
    public function registerAsUser(UserRequest $userRequest): User
    {
        $user = $this->userFactory->createFromUserRequest($userRequest);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        /**
         * @var EventDispatcher $dispatcher
         */
        $dispatcher->dispatch(UserEvents::USER_CREATED, new UserEvent($user));

        return $user;

    }
}