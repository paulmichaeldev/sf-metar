<?php
namespace App\Controller;

use App\Entity\Airport;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AirportController
{
    /**
     * @Route("/airports", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager)
    {
        $airportRepository = $entityManager->getRepository(Airport::class);
        $airports = $airportRepository->findAll();

        $airportList = [];

        foreach ($airports as $airport) {
            $airportList[] = [
                'code' => $airport->getCode(),
                'name' => $airport->getName(),
                'uuid' => $airport->getUuid()
            ];
        }

        return new JsonResponse([
            'airports' => $airportList
        ]);
    }

    /**
     * @Route("/airport/{airportCode}", methods={"GET"})
     */
    public function show(EntityManagerInterface $entityManager, $airportCode)
    {
        $airportCode = strtoupper($airportCode);

        $airportRepository = $entityManager->getRepository(Airport::class);
        $airport = $airportRepository->findOneBy(['code' => $airportCode]);

        return new JsonResponse([
            'airport' => [
                'code' => $airport->getCode(),
                'name' => $airport->getName(),
                'uuid' => $airport->getUuid()
            ]
        ]);
    }
}