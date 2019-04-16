<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MetarCloudLayerRepository")
 */
class MetarCloudLayer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $metar_id;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $sky_cover;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cloud_base;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMetarId(): ?int
    {
        return $this->metar_id;
    }

    public function setMetarId(int $metar_id): self
    {
        $this->metar_id = $metar_id;

        return $this;
    }

    public function getSkyCover(): ?string
    {
        return $this->sky_cover;
    }

    public function setSkyCover(?string $sky_cover): self
    {
        $this->sky_cover = $sky_cover;

        return $this;
    }

    public function getCloudBase(): ?int
    {
        return $this->cloud_base;
    }

    public function setCloudBase(?int $cloud_base): self
    {
        $this->cloud_base = $cloud_base;

        return $this;
    }
}
