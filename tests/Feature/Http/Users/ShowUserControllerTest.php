<?php

namespace Tests\Feature\Http\Users;

use Nette\Utils\Random;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class ShowUserControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $category = UserGenerator::generate();
        $response = $this->get(route('users.show', [
            'user' => $category->id,
        ]), [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertSuccessful();
    }

    public function testEmptyAnswerExpectsNotFound(): void
    {
        $response = $this->get(route('users.show', [
            'user' => Random::generate(4, '0-9'),
        ]), [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertNotFound();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $response = $this->delete(route('users.show', [
            'user' => Random::generate(2, 'a-z'),
        ]), [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertNotFound();
    }
}
