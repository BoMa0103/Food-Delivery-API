<?php

namespace Tests\Feature\Http\Packages;

use Tests\Generators\PackageGenerator;
use Tests\TestCase;

class IndexPackageControllerTest extends TestCase
{
    public function testExpectsSuccess(): void
    {
        for ($i = 0; $i < 10; $i++) {
            PackageGenerator::generate();
        }

        $response = $this->get(route('dishes.index'), [
            'Authorization' => 'Bearer ' . $this->generateUserBearerToken(),
        ]);

        $response->assertSuccessful();
    }

    public function testExpectsUnauthorized(): void
    {
        for ($i = 0; $i < 10; $i++) {
            PackageGenerator::generate();
        }

        $response = $this->get(route('packages.index'));

        $response->assertUnauthorized();
    }
}
