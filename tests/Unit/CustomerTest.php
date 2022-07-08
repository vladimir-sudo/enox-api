<?php

namespace App\Tests\Unit;

use App\Entity\Customer;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CustomerTest extends KernelTestCase
{
    /** @test */
    public function tesCustomer(): void
    {
        self::bootKernel();
        $faker = Factory::create();
        
        $fullName = $faker->firstName() . ' ' . $faker->lastName;
        $userName = $faker->userName;
        $phone = $faker->phoneNumber;
        $email = $faker->email;
        $country = $faker->country;
        $city = $faker->city;

        $customer = new Customer();
        $customer->setFullName($fullName);
        $customer->setUserName($userName);
        $customer->setPhone($phone);
        $customer->setEmail($email);
        $customer->setGender('female');
        $customer->setCountry($country);
        $customer->setCity($city);

        $this->assertEquals($fullName, $customer->getFullName());
        $this->assertEquals($userName, $customer->getUserName());
        $this->assertEquals($phone, $customer->getPhone());
        $this->assertEquals($email, $customer->getEmail());
        $this->assertEquals('female', $customer->getGender());
        $this->assertEquals($country, $customer->getCountry());
        $this->assertEquals($city, $customer->getCity());
    }
}
