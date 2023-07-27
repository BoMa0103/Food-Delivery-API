<?php

namespace Tests\Feature\Services\Users\Repositories;

use App\Models\User;
use App\Services\Users\DTO\StoreUserDTO;
use App\Services\Users\DTO\UpdateUserDTO;
use App\Services\Users\Repositories\EloquentUserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Nette\Utils\Random;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class EloquentUserRepositoryTest extends TestCase
{
    use RefreshDatabase;
    private function getEloquentUserRepository(): EloquentUserRepository
    {
        return app(EloquentUserRepository::class);
    }

    public function testFindExpectsNotNull():void
    {
        $model = UserGenerator::generate();
        $company = $this->getEloquentUserRepository()->find($model->id);
        $this->assertNotNull($company);
    }

    public function testFindExpectsNull():void
    {
        $id = Random::generate(3, '0-9');
        $company = $this->getEloquentUserRepository()->find($id);

        $this->assertNull($company);
    }

    public function testCreateExpectsSuccess():void
    {
        $dto = StoreUserDTO::fromArray(
            UserGenerator::storeUserDTOArrayGenerate()
        );
        $this->getEloquentUserRepository()->store($dto);

        $model = User::query()->where('name', $dto->getName())->first();
        $this->assertEquals($dto->getName(), $model->name);
        $this->assertEquals($dto->getEmail(), $model->email);
        $this->assertDatabaseCount('users', 1);
    }

    public function testUpdateExpectsSuccess():void
    {
        $user = UserGenerator::generate();
        $dto = UpdateUserDTO::fromArray(
            UserGenerator::updateUserDTOArrayGenerate([
                'name' => $user->name,
            ])
        );
        $oldUserName = $user->name;
        $oldUserEmail = $user->email;
        $this->getEloquentUserRepository()->update($user, $dto);

        $user->refresh();

        $this->assertEquals($oldUserName, $user->name);
        $this->assertNotEquals($oldUserEmail, $user->email);
    }

    public function testDeleteExpectsSuccess():void
    {
        $user = UserGenerator::generate();
        $this->getEloquentUserRepository()->delete($user->id);

        $this->assertNull($user->fresh());
        $this->assertDatabaseCount('users', 0);
    }
}
