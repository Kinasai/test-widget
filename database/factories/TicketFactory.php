<?php

namespace Database\Factories;

use App\Enums\TicketStatus;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class TicketFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(TicketStatus::cases());

        if(Customer::query()->count()){
            $customer_id = fake()->boolean(20) ? Customer::factory()->create()->id : Customer::query()->inRandomOrder()->first()->id;
        }else{
            $customer_id = Customer::factory()->create()->id;
        }

        return [
            'customer_id' => $customer_id,
            'title' => fake()->text(fake()->numberBetween(10, 40)),
            'text' => fake()->text(),
            'status' => $status,
            'response_date' => $status == TicketStatus::Processed ? fake()->dateTime() : null,
        ];
    }
}
