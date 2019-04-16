<?php

namespace App\Service;

use App\Entity\MetarCloudLayer;
use Doctrine\ORM\EntityManagerInterface;

class Metar
{
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function addCloudLayer(\App\Entity\Metar $metar, $skyCover, $cloudBase)
    {
        if (empty($skyCover)) {
            return null;
        }

        $cloudLayer = new MetarCloudLayer();
        $cloudLayer->setMetarId($metar->getId());
        $cloudLayer->setSkyCover($skyCover);
        $cloudLayer->setCloudBase((int) $cloudBase);

        $this->entityManager->persist($cloudLayer);
        $this->entityManager->flush();

        return $cloudLayer;
    }
}