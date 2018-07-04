<?php
/**
 * Created by PhpStorm.
 * User: Etudiant0
 * Date: 29/06/2018
 * Time: 11:24
 */

namespace App\Factory;


use App\Entity\User;
use App\Request\UserRequest;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFactory
{

private $encoder;
    /**
     * UserFactory constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @param UserRequest $request
     * @return User
     */
    public function createFromUserRequest(UserRequest $request): User
    {
        $user = new User();
        $user->setFirstName($request->getFirstName());
        $user->setLastName($request->getLastName());
        $user->setEmail($request->getEmail());
        $user->setPassword($this->encoder->encodePassword($user, $request->getPassword()));

        return $user;
//        return new User(
//            '',
//            $request->getFirstName(),
//            $request->getLastName(),
//            $request->getEmail(),
//            $request->getPassword(),
//            $request->getRegistrationDate(),
//            $request->getRoles(),
//        );
    }
}