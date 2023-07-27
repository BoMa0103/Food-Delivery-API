<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Company;
use App\Models\Dish;
use App\Models\Order;
use App\Models\Package;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $company = Company::factory()->create();
        $category = Category::factory()->for($company)->create();
        $user = User::factory()->create();
        $package = Package::factory()->for($company)->create();
        Dish::factory(10)->for($category)->for($package)->create();
        Order::factory(2)->for($company)->for($user)->create();
        $company->setAttribute('base_package_id', $package->getAttribute('id'));
        $company->save();
    }
}
