<?php

namespace Tests\Feature\Http\Packages;

use Nette\Utils\Random;
use Tests\Generators\PackageGenerator;
use Tests\TestCase;

class ShowPackageControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $package = PackageGenerator::generate();
        $response = $this->get(route('packages.show', [
            'package' => $package->id,
        ]), [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertSuccessful();
    }

    public function testEmptyAnswerExpectsNotFound(): void
    {
        $response = $this->get(route('packages.show', [
            'package' => Random::generate(4, '0-9'),
        ]), [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertNotFound();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $response = $this->delete(route('packages.show', [
            'package' => Random::generate(2, 'a-z'),
        ]), [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertNotFound();
    }
}
