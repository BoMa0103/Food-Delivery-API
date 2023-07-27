<?php

use App\Services\Orders\DTO\OrderDTO;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->json('cart_items');
            $table->foreignId('company_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->tinyInteger('deliveryType');
            // як краще зберігати час
            $table->integer('deliveryTime')
                ->default(OrderDTO::DELIVERY_TIME_AS_SOON_AS_POSSIBLE->value);
            $table->string('deliveryAddressStreet')->nullable();
            $table->string('deliveryAddressHouse')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
