<?php

namespace App\Services;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

abstract class EntityService
{
    /** @var ServiceEntityRepository */
    protected $repository;

    /** @var EntityManager */
    protected $entityManager;

    /** @var */
    protected $entity;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository($this->entity);
    }

    public function add($entity)
    {
        $this->checkIsOpenEntityManager();

        $this->entityManager->persist($entity);

        return $entity;
    }

    public function save($entity)
    {
        $this->checkIsOpenEntityManager();

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    public function delete($entity)
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    public function checkIsOpenEntityManager()
    {
        if (!$this->entityManager->isOpen()) {
            $this->entityManager = $this->entityManager->create(
                $this->entityManager->getConnection(),
                $this->entityManager->getConfiguration()
            );
        }
    }
}