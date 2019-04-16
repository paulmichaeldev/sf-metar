<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StationRepository")
 */
class Station
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $station_code;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=6)
     */
    private $lat;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=6)
     */
    private $lng;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStationCode(): ?string
    {
        return $this->station_code;
    }

    public function setStationCode(string $station_code): self
    {
        $this->station_code = $station_code;

        return $this;
    }

    public function getLat()
    {
        return $this->lat;
    }

    public function setLat($lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng()
    {
        return $this->lng;
    }

    public function setLng($lng): self
    {
        $this->lng = $lng;

        return $this;
    }
}
