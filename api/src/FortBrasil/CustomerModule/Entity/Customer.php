<?php
namespace FortBrasil\CustomerModule\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * Class Customer
 * @package FortBrasil\CustomerModule\Entity
 * @ORM\Entity()
 * @ORM\Table(name="customers")
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(name="first_name", type="string", length=255, nullable=false)
     */
    public $firstName;

    /**
     * @ORM\Column(name="last_name", type="string", length=255, nullable=false)
     */
    public $lastName;

    /**
     * @ORM\Column(name="cpf", type="string", length=11, nullable=false)
     */
    public $cpf;

    /**
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    public $birthday;

    /**
     * @ORM\Column(name="genre", type="string", length=1, nullable=true)
     */
    public $genre;

    static public function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('firstName', new Assert\NotBlank());
        $metadata->addPropertyConstraint('lastName', new Assert\NotBlank());
        $metadata->addPropertyConstraint('cpf', new Assert\NotBlank());
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
     * @return Customer
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
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
     * @return Customer
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     * @return Customer
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     * @return Customer
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     * @return Customer
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
        return $this;
    }


}