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
        ]));

        $response->assertSuccessful();
    }

    public function testEmptyAnswerExpectsSuccess(): void
    {
        $response = $this->get(route('users.show', [
            'user' => Random::generate(2, '0-9'),
        ]));

        $response->assertSuccessful();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $response = $this->delete(route('users.show', [
            'user' => Random::generate(2, 'a-z'),
        ]));

        $response->assertNotFound();
    }
}
