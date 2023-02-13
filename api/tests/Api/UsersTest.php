<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class UsersTest extends ApiTestCase
{
    public function testCreateUser(): void {
        $response = static::createClient()->request('POST', '/api/users', ['json' => [
            'email' => 'test@email.com',
            'name' => 'test',
            'password' => 'test',
        ]]);

        $this->assertResponseStatusCodeSame(201);
    }

}
