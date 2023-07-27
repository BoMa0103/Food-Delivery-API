<?php

namespace App\Models;

use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property float $number
 * @property int $company_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Company $company
 * @method static OrderFactory factory($count = null, $state = [])
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereCompanyId($value)
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereNumber($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @property array $cart_items
 * @method static Builder|Order whereCartItems($value)
 * @property int $user_id
 * @property int $deliveryType
 * @property int $deliveryTime
 * @property-read User $user
 * @method static Builder|Order whereDeliveryTime($value)
 * @method static Builder|Order whereDeliveryType($value)
 * @method static Builder|Order whereUserId($value)
 * @property string|null $deliveryAddressStreet
 * @property string|null $deliveryAddressHouse
 * @method static Builder|Order whereDeliveryAddressHouse($value)
 * @method static Builder|Order whereDeliveryAddressStreet($value)
 * @property array $prices
 * @property array $package
 * @method static Builder|Order wherePackage($value)
 * @method static Builder|Order wherePrices($value)
 * @method static Builder|Order whereUser($value)
 */
class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'cart_items' => 'array',
        'prices' => 'array',
        'user' => 'array',
        'package' => 'array',
    ];
}
