<?php

namespace App\Models;

use Database\Factories\PackageFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Package
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property string $description
 * @property int $company_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read Company $company
 * @method static PackageFactory factory($count = null, $state = [])
 * @method static Builder|Package newModelQuery()
 * @method static Builder|Package newQuery()
 * @method static Builder|Package query()
 * @method static Builder|Package whereCompanyId($value)
 * @method static Builder|Package whereCreatedAt($value)
 * @method static Builder|Package whereDescription($value)
 * @method static Builder|Package whereId($value)
 * @method static Builder|Package whereName($value)
 * @method static Builder|Package wherePrice($value)
 * @method static Builder|Package whereUpdatedAt($value)
 * @property-read Collection<int, Dish> $dishes
 * @property-read int|null $dishes_count
 */
class Package extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [''];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }
}
