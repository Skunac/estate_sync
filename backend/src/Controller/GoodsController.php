<?php

namespace App\Controller;

use App\Entity\Good;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GoodsController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }
    #[Route('/goods', name:'api_goods')]
    public function showGoods(): JsonResponse
    {
        $allGoods = $this->entityManager->getRepository(Good::class)->findAll();
        return new JsonResponse(data: $allGoods);
    }

}