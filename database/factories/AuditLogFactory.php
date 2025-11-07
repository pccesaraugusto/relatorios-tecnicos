<?php

namespace Database\Factories;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuditLogFactory extends Factory
{
    protected $model = AuditLog::class;

    public function definition()
    {
        return [
            'user_id' => 1,
            'action' => $this->faker->randomElement(['created', 'updated', 'deleted']),
            'old_values' => json_encode(['field1' => 'old value']),
            'new_values' => json_encode(['field1' => 'new value']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
