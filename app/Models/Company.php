<?php

namespace App\Models;

use Database\Factories\CompanyFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Company
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property float $rating
 * @property int $status
 * @property string|null $description
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read Collection<int, Category> $categories
 * @property-read int|null $categories_count
 * @method static CompanyFactory factory($count = null, $state = [])
 * @method static Builder|Company newModelQuery()
 * @method static Builder|Company newQuery()
 * @method static Builder|Company query()
 * @method static Builder|Company whereAddress($value)
 * @method static Builder|Company whereCreatedAt($value)
 * @method static Builder|Company whereDescription($value)
 * @method static Builder|Company whereId($value)
 * @method static Builder|Company whereName($value)
 * @method static Builder|Company whereRating($value)
 * @method static Builder|Company whereStatus($value)
 * @method static Builder|Company whereUpdatedAt($value)
 * @property-read Collection<int, Order> $orders
 * @property-read int|null $orders_count
 * @property int|null $base_package_id
 * @method static Builder|Company whereBasePackageId($value)
 */
class Company extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [''];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
