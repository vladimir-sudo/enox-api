<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 * @ORM\Table(name="`customer`")
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @Groups({"list", "single"})
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"list", "single"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fullName;

    /**
     * @Groups({"list"})
     * @ORM\Column(type="string", length=180, unique=true, nullable=true)
     */
    private $email;

    /**
     * @Groups({"list", "single"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @Groups({"single"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userName;

    /**
     * @Groups({"single"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gender;

    /**
     * @Groups({"single"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @Groups({"single"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    public function getId(): ?int
    {
        return $this->id;
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
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName): void
    {
        $this->fullName = $fullName;
    }
}
