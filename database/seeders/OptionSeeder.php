<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Option::create([
            "label"=>"URL Agenda",
            "key"=>"URL_AGENDA",
            "value"=>"https://www.youtube.com/watch?v=dQw4w9WgXcQ",
            "description"=>"URL tujuan yang dirujuk oleh menu agenda",
        ]);
    }
}
