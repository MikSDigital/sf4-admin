<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FileRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class File
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mimeType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $extension;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $orderr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filename;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $parameters;

    /**
     * @ORM\Column(type="boolean")
     */
    private $garbage;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $garbageTimestamp;

    public function getId()
    {
        return $this->id;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function setMimeType(?string $mimeType): self
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(?string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    public function getOrderr(): ?int
    {
        return $this->orderr;
    }

    public function setOrderr(?int $orderr): self
    {
        $this->orderr = $orderr;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getParameters(): ?array
    {
        return $this->parameters;
    }

    public function setParameters(?array $parameters): self
    {
        $this->parameters = $parameters;

        return $this;
    }

    public function isGarbage(): ?bool
    {
        return $this->garbage;
    }

    /**
     * @param boolean $garbage
     * @param \DateTime $garbageTimestamp
     *
     * @return File
     */
    public function setGarbage($garbage, \DateTime $garbageTimestamp = null)
    {
        $this->garbage = $garbage;

        if ($garbageTimestamp == null)
        {
            $garbageTimestamp = new \DateTime();
        }
        $this->setGarbageTimestamp($garbageTimestamp);

        return $this;
    }

    public function getGarbageTimestamp(): ?\DateTimeInterface
    {
        return $this->garbageTimestamp;
    }

    public function setGarbageTimestamp(?\DateTimeInterface $garbageTimestamp): self
    {
        $this->garbageTimestamp = $garbageTimestamp;

        return $this;
    }

    /**
     * Returns if this file is an image based on the mime type
     *
     * @return bool
     */
    public function isImage()
    {
        return strtolower(substr($this->getMimeType(), 0, 5)) == 'image';
    }

    public function getGarbage(): ?bool
    {
        return $this->garbage;
    }
}
