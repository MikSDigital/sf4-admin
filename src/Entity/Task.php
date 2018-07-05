<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
use Doctrine\Common\Collections\ArrayCollection;

class Task
{
    protected $description;

    protected $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getTags()
    {
        return $this->tags;
    }
}
