<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ORM\Entity(repositoryClass="App\Repository\TagRepository")
 */
class Tag
{
    private $name;
    private $isValid;

    /**
     * @return mixed
     */
    public function getisValid()
    {
        return $this->isValid;
    }

    /**
     * @param mixed $isValid
     */
    public function setIsValid($isValid)
    {
        $this->isValid = $isValid;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
