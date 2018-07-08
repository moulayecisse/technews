<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 03/07/2018
 * Time: 16:51
 */

namespace App\Service\Event;


use App\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class UserEvent extends Event
{
    private $user;

    /**
     * UserEvent constructor.
     * @param $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }


}