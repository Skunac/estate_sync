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

class AdsController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }
    #[Route('/ads', name:'api_advertisements', methods: ['GET'])]
    public function showAdvertisements(): JsonResponse
    {
        $allAds = $this->entityManager->getRepository(Advertisement::class)->findAll();
        return $this->json(data: $allAds);
    }

    #[Route('/create_ad', name: 'api_advertisement_create', methods: ['POST'])]
    public function createAdvertisement(Request $request): JsonResponse
    {
        $data = $request->request->all();

        if ($data === null) {
            return $this->json(['message' => 'Invalid JSON data'], Response::HTTP_BAD_REQUEST);
        }

        $good = $this->entityManager->getRepository(Good::class)->findOneByTitle($request->request->get('good'));


        $advertisement = new Advertisement();
        $advertisement->setTitle($data['title']);
        $advertisement->setDescription($data['description']);
        $advertisement->setPrice((int)$data['price']);
        $advertisement->setAddress($data['address']);
        $advertisement->setNumberOfRooms($data['numberOfRooms']);
        $advertisement->setNumberOfBathrooms($data['numberOfBathrooms']);
        $advertisement->setArea((int)$data['area']);
        $advertisement->setGood($good);
        $advertisement->setPublicationDate(new \DateTimeImmutable());


        $this->entityManager->persist($advertisement);
        $this->entityManager->flush();

        return $this->json(['message' => 'Advertisement created successfully'], Response::HTTP_CREATED);
    }

    #[Route('/update_ad/{id}', name: 'api_advertisement_update', methods: ['PUT'])]
    public function updateAdvertisement(Request $request, int $id): JsonResponse
    {
        $advertisement = $this->entityManager->getRepository(Advertisement::class)->find($id);

        if (!$advertisement) {
            return $this->json(['message' => 'Advertisement not found'], Response::HTTP_NOT_FOUND);
        }

        $data = $request->request->all();

        if ($data === null) {
            return $this->json(['message' => 'Invalid JSON data'], Response::HTTP_BAD_REQUEST);
        }

        $advertisement->setTitle($data['title']);
        $advertisement->setDescription($data['description']);
        $advertisement->setPrice((int)$data['price']);
        $advertisement->setAddress($data['address']);
        $advertisement->setNumberOfRooms($data['numberOfRooms']);
        $advertisement->setNumberOfBathrooms($data['numberOfBathrooms']);
        $advertisement->setArea((int)$data['area']);

        $this->entityManager->persist($advertisement);
        $this->entityManager->flush();

        return $this->json(['message' => 'Advertisement updated successfully'], Response::HTTP_OK);
    }

    #[Route('/delete_ad/{id}', name: 'api_advertisement_delete', methods: ['DELETE'])]
    public function deleteAdvertisement(int $id): JsonResponse
    {
        $advertisement = $this->entityManager->getRepository(Advertisement::class)->find($id);

        if (!$advertisement) {
            return $this->json(['message' => 'Advertisement not found'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($advertisement);
        $this->entityManager->flush();

        return $this->json(['message' => 'Advertisement deleted successfully'], Response::HTTP_OK);
    }
}