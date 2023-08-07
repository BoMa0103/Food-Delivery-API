<?php

namespace Tests\Feature\Http\Packages;

use Nette\Utils\Random;
use Tests\Generators\PackageGenerator;
use Tests\TestCase;

class DeletePackageControllerTest extends TestCase
{
    public function testExpectsNoContent(): void
    {
        $package = PackageGenerator::generate();
        $response = $this->delete(route('packages.delete', [
            'package' => $package->id,
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
        ]);

        $response->assertNoContent();
    }

    public function testExpectsForbidden(): void
    {
        $package = PackageGenerator::generate();
        $response = $this->delete(route('packages.delete', [
            'package' => $package->id,
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertForbidden();
    }

    public function testPackageDoesNotExistExpectsNoContent(): void
    {
        $response = $this->delete(route('packages.delete', [
            'package' => Random::generate(4, '1-9'),
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
        ]);

        $response->assertNoContent();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $response = $this->delete(route('packages.delete', [
            'package' => Random::generate(2, 'a-z'),
        ]), [], [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken('admin'),
        ]);

        $response->assertNotFound();
    }
}
