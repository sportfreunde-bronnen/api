<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="customer")
 */
class Customer extends Base
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(name="firstname", type="string", length=100)
     * @var string
     */
    protected $firstName;

    /**
     * @ORM\Column(name="lastname", type="string", length=100)
     * @var string
     */
    protected $lastName;

    /**
     * @return integer
     */
    public function getId() : integer
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId(integer $id) : void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName() : string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName() : string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }
}
