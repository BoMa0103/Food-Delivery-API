<?php

namespace Tests\Feature\Http\Packages;

use Nette\Utils\Random;
use Tests\Generators\PackageGenerator;
use Tests\TestCase;

class DeletePackageControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        $package = PackageGenerator::generate();
        $response = $this->delete(route('packages.delete', [
            'package' => $package->id,
        ]));

        $response->assertNoContent();
    }

    public function testPackageDoesNotExistExpectsNoContent(): void
    {
        $response = $this->delete(route('packages.delete', [
            'package' => Random::generate(4, '1-9'),
        ]));

        $response->assertNoContent();
    }

    public function testIdIsNotIntExpectsNotFound(): void
    {
        $response = $this->delete(route('packages.delete', [
            'package' => Random::generate(2, 'a-z'),
        ]));

        $response->assertNotFound();
    }
}
