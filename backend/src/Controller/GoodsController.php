<?php

namespace App\Controller;


use App\Entity\Advertisement;
use App\Entity\Good;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GoodsController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }
    #[Route('/goods', name:'api_goods', methods: ['GET'])]
    public function showGoods(): JsonResponse
    {
        $allGoods = $this->entityManager->getRepository(Good::class)->findAll();
//        dd($allGoods);
        return $this->json(data: $allGoods);
    }

    #[Route('/create_good', name:'api_good_create', methods: ['POST'])]
    public function createGood(Request $request): JsonResponse
    {
        $data = $request->request->all();

        if ($data === null){
            return $this->json(['message' => 'Invalid JSON data'], Response::HTTP_BAD_REQUEST);
        }

        $good = new Good();
        $good->setTitle($data['title']);

        $this->entityManager->persist($good);
        $this->entityManager->flush();

        return $this->json(['message' => 'Good created successfully'], Response::HTTP_CREATED);
    }

    #[Route('/update_good/{id}', name:'api_good_update', methods: ['PUT'])]
    public function updateGood(Request $request, int $id): JsonResponse
    {
        $good = $this->entityManager->getRepository(Good::class)->find($id);

        if (!$good) {
            return $this->json(['message' => 'Good not found'], Response::HTTP_NOT_FOUND);
        }

        $data = $request->request->all();

        if ($data === null) {
            return $this->json(['message' => 'Invalid JSON data'], Response::HTTP_BAD_REQUEST);
        }

        $good->setTitle($data['title']);

        $this->entityManager->persist($good);
        $this->entityManager->flush();

        return $this->json(['message' => 'Good modified successfully'], Response::HTTP_CREATED);
    }

    #[Route('/delete_good/{id}', name:'api_good_delete', methods: ['DELETE'])]
    public function deleteGood(Request $request, int $id): JsonResponse
    {
        $good = $this->entityManager->getRepository(Good::class)->find($id);

        if(!$good){
            return $this->json(['message' => 'Good not found'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($good);
        $this->entityManager->flush();

        return $this->json(['message' => 'Good deleted successfully'], Response::HTTP_OK);
    }
}