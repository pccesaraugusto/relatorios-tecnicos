<?php

namespace Database\Factories;

use App\Models\ReportSignature;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportSignatureFactory extends Factory
{
    protected $model = ReportSignature::class;

    public function definition()
    {
        return [
            'report_id' => 1, // ajuste conforme necessário, talvez vinculando com Report::factory()
            'user_id' => 1,   // ajuste conforme necessário, talvez vinculando com User::factory()
            'signature' => $this->faker->text(100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
