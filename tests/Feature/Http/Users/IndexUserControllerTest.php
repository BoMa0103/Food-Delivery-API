<?php

namespace Tests\Feature\Http\Users;

use Tests\Generators\UserGenerator;
use Tests\TestCase;

class IndexUserControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        for ($i = 0; $i < 10; $i++) {
            UserGenerator::generate();
        }

        $response = $this->get(route('users.index'), [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertSuccessful();
    }

    public function testExpectsUnauthorized(): void
    {
        for ($i = 0; $i < 10; $i++) {
            UserGenerator::generate();
        }

        $response = $this->get(route('users.index'));

        $response->assertUnauthorized();
    }
}
