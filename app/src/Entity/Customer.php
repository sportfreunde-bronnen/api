<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="customer")
 */
class Customer extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
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
     * @ORM\Column(name="street", type="string", length=100)
     * @var string
     */
    protected $street;

    /**
     * @ORM\Column(name="zipcode", type="string", length=25)
     * @var string
     */
    protected $zipcode;

    /**
     * @ORM\Column(name="city", type="string", length=100)
     * @var string
     */
    protected $city;

    /**
     * @ORM\Column(name="email", type="string", length=70)
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column(name="phone", type="string", length=50)
     * @var string
     */
    protected $phone;

    /**
     * @ORM\Column(name="delivery_firstname", type="string", length=100, nullable=true)
     * @var string
     */
    protected $deliveryFirstName;

    /**
     * @ORM\Column(name="delivery_lastname", type="string", length=100, nullable=true)
     * @var string
     */
    protected $deliveryLastName;

    /**
     * @ORM\Column(name="delivery_street", type="string", length=100, nullable=true)
     * @var string
     */
    protected $deliveryStreet;

    /**
     * @ORM\Column(name="delivery_zipcode", type="string", length=25, nullable=true)
     * @var string
     */
    protected $deliveryZipcode;

    /**
     * @ORM\Column(name="delivery_city", type="string", length=100, nullable=true)
     * @var string
     */
    protected $deliveryCity;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getDeliveryFirstName()
    {
        return $this->deliveryFirstName;
    }

    /**
     * @param string $deliveryFirstName
     */
    public function setDeliveryFirstName($deliveryFirstName)
    {
        $this->deliveryFirstName = $deliveryFirstName;
    }

    /**
     * @return string
     */
    public function getDeliveryLastName()
    {
        return $this->deliveryLastName;
    }

    /**
     * @param string $deliveryLastName
     */
    public function setDeliveryLastName($deliveryLastName)
    {
        $this->deliveryLastName = $deliveryLastName;
    }

    /**
     * @return string
     */
    public function getDeliveryStreet()
    {
        return $this->deliveryStreet;
    }

    /**
     * @param string $deliveryStreet
     */
    public function setDeliveryStreet($deliveryStreet)
    {
        $this->deliveryStreet = $deliveryStreet;
    }

    /**
     * @return string
     */
    public function getDeliveryZipcode()
    {
        return $this->deliveryZipcode;
    }

    /**
     * @param string $deliveryZipcode
     */
    public function setDeliveryZipcode($deliveryZipcode)
    {
        $this->deliveryZipcode = $deliveryZipcode;
    }

    /**
     * @return string
     */
    public function getDeliveryCity()
    {
        return $this->deliveryCity;
    }

    /**
     * @param string $deliveryCity
     */
    public function setDeliveryCity($deliveryCity)
    {
        $this->deliveryCity = $deliveryCity;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
}
