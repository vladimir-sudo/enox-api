<?php

namespace App\Tests\Api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\DataFixtures\CustomerFixture;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class CustomerApiTest extends ApiTestCase
{
    /** @Test */
    public function testGetCustomers(): void
    {
        $response = static::createClient()->request('GET', '/api/customers');
        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json');
        $this->assertIsArray(json_decode($response->getContent()));
    }

    /** @Test */
    public function testCustomer(): void
    {
        $response = static::createClient()->request('GET', '/api/customers/1');
        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame('content-type', 'application/json');

        $finishedData = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('fullName', $finishedData);
        $this->assertArrayHasKey('country', $finishedData);
        $this->assertArrayHasKey('userName', $finishedData);
        $this->assertArrayHasKey('gender', $finishedData);
        $this->assertArrayHasKey('city', $finishedData);
        $this->assertArrayHasKey('phone', $finishedData);
    }
}
