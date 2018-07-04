<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 29/06/2018
 * Time: 10:36
 */

namespace App\Request;

//On a plus de souplesse avec dce fichier, en terme de logique c'est beaucoup plus propre car on a un automatisme spécifique pour un besoin.

use Symfony\Component\Validator\Constraints as Assert;

class UserRequest
{
    /**
     * @Assert\NotBlank(message="N oubliez pas votre Prénom.")
     * @Assert\Length(max=50, maxMessage="Votre prénom est trop long. Pas plus de {{ limit }} caractères")
     *
     */
    private $firstName;
    /**
     * @Assert\NotBlank(message="N oubliez pas votre nom.")
     * @Assert\Length(max=50, maxMessage="Votre nom est trop long. Pas plus de {{ limit }} caractères")
     *
     */
    private $lastName;

    /**
     * @Assert\NotBlank(message="N oubliez pas votre email.")
     * @Assert\Length(max=80, maxMessage="Votre email est trop long. Pas plus de {{ limit }} caractères")
     * @Assert\Email(message="Vérifiez votre email")
     */
    private $email;

    /**
     * @Assert\NotBlank(message="N oubliez pas votre password.")
     * @Assert\Length
     * (
     *     min=8,
     *     max=20,
     *     minMessage="Votre password est trop court. {{limit}}",
     *     maxMessage="Votre password est trop long. Pas plus de {{ limit }} caractères"
     * )
     */
    private $password;

    /**
     * @Assert\IsTrue(message="Vous devez valider nos CGU.")
     */
    private $conditions;

    /**------------------*/
    private $registrationDate;

    private $roles;

    /**------------------*/

    /**
     * UserRequest constructor.
     * @param string $role
     */
    public function __construct(string $role = 'ROLE_USER')
    {
        $this->registrationDate = new \Datetime();
        $this->roles[] = $role;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    /**
     * @param mixed $registrationDate
     */
    public function setRegistrationDate($registrationDate): void
    {
        $this->registrationDate = $registrationDate;
    }



    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @param mixed $conditions
     */
    public function setConditions($conditions): void
    {
        $this->conditions = $conditions;
    }

    /**
     * @return mixed
     */
    public function getConditions()
    {
        return $this->conditions;
    }
}