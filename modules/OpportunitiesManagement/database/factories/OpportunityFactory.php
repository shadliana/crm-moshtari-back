<?php

namespace Modules\OpportunitiesManagement\Database\Factories\OpportunityFactory;



use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\OpportunitiesManagement\app\Models\Opportunity;
use Modules\UserManagement\app\Models\User;

/**
 * @extends Factory<Opportunity>
 */
class OpportunityFactory extends Factory
{
    protected $model = Opportunity::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title,
            'related_customer' => fake()->name,
            'cost' => fake()->numberBetween(1,10),
            'status' => fake()->randomElement(Opportunity::$statuses),
            'created_by_id'=> User::factory()
        ];
    }
}
