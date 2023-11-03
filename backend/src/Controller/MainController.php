<?php

namespace App\Controller;

use App\Entity\Advertisement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    #[Route('/ads', name:'api_advertisements')]
    public function showAdvertisements(): Response
    {
        $allAds = $this->entityManager->getRepository(Advertisement::class)->findAll();
        dd($allAds);
        /*return new JsonResponse(data: $allAds);*/
    }


}
