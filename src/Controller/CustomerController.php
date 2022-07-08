<?php

namespace App\Controller;

use App\Services\User\CustomerService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Serializer;

class CustomerController extends AbstractController
{
    protected $service;

    public function __construct(CustomerService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/api/customers")
     */
    public function getList()
    {
        $users = $this->service->getRepository()->findAll();

        /** @var Serializer $serializer */
        $serializer = $this->container->get('serializer');
        $serializedEntity = $serializer
            ->serialize($users, 'json', ['groups' => 'list']);

        return new JsonResponse($serializedEntity);
    }

    /**
     * @Route("/api/customers/{customerId}")
     */
    public function getSingleUser($customerId)
    {
        $user = $this->service->getRepository()->find($customerId);

        /** @var Serializer $serializer */
        $serializer = $this->container->get('serializer');
        $serializedEntity = $serializer
            ->serialize($user, 'json', ['groups' => 'single']);

        return new JsonResponse($serializedEntity);
    }
}