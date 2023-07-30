<?php

namespace App\Models;

use Database\Factories\DishFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Dish
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property float $price
 * @property string $image
 * @property int $category_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read Category $category
 * @method static DishFactory factory($count = null, $state = [])
 * @method static Builder|Dish newModelQuery()
 * @method static Builder|Dish newQuery()
 * @method static Builder|Dish query()
 * @method static Builder|Dish whereCategoryId($value)
 * @method static Builder|Dish whereCreatedAt($value)
 * @method static Builder|Dish whereDescription($value)
 * @method static Builder|Dish whereId($value)
 * @method static Builder|Dish whereName($value)
 * @method static Builder|Dish wherePrice($value)
 * @method static Builder|Dish whereUpdatedAt($value)
 * @property int|null $package_id
 * @property-read Package|null $package
 * @method static Builder|Dish wherePackageId($value)
 */
class Dish extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
