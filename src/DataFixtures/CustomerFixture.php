<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CustomerFixture extends Fixture
{
    private $count = 10;

    /**
     * @var Factory
     */
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        for ($c = 0; $c <= $this->count; $c++) {
            $this->makeCustomer($manager);
        }
        $manager->flush();
    }

    public function makeCustomer($manager, $isFlush = false)
    {
        $customer = new Customer();

        $customer->setFullName($this->faker->firstName() . ' ' . $this->faker->lastName);
        $customer->setUserName($this->faker->userName);
        $customer->setPhone($this->faker->phoneNumber);
        $customer->setEmail($this->faker->email);
        $customer->setGender('female');
        $customer->setCountry($this->faker->country);
        $customer->setCity($this->faker->city);

        if ($isFlush) {
            $manager->persist($customer);
            $manager->refresh($customer);
        }
        return $customer;
    }
}
