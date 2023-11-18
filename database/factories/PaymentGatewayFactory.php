<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentGateway>
 */
class PaymentGatewayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Binance',
            'name_slug' => 'binance',
            'code' => 'TR5nwgbzRi62yAEU4tK6rgFty3FgfNbN7k',
            'qrcode_dir' => 'images/site/gateway/qrcode/',
            'qrcode_file_name' => 'qr.png',
        ];
    }
}
