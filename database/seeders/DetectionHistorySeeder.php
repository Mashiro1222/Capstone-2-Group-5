<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetectionHistory;

class DetectionHistorySeeder extends Seeder
{
    public function run()
    {
        DetectionHistory::factory(10)->create();
    }
}
