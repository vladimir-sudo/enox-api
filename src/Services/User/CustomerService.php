<?php


namespace App\Services\User;


use App\Entity\Customer;
use App\Repository\UserRepository;
use App\Services\EntityService;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UserService
 * @package App\Services\User
 */
class CustomerService extends EntityService
{
    /**
     * @var string
     */
    protected $entity = Customer::class;

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * CustomerService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
    }

    /**
     * @param object $userData
     * @return mixed
     */
    public function create(object $userData, $isFlush = true)
    {
        /** @var Customer $user */
        $user = new $this->entity;
        $user->setCity($userData->location->city);
        $user->setCountry($userData->location->country);
        $user->setGender($userData->gender);
        $user->setEmail($userData->email);
        $user->setPhone($userData->phone);
        $user->setFullName($userData->name->first . ' ' . $userData->name->last);
        $user->setUserName($userData->login->username);

        if ($isFlush) {
            return $this->save($user);
        }
        return $this->add($user);
    }

    /**
     * @return mixed
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @return \Doctrine\ORM\EntityManager|EntityManagerInterface
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }
}